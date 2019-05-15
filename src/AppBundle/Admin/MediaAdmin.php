<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\File;

/**
 * Media Admin class
 */
final class MediaAdmin extends AbstractAdmin
{
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        if (!$this->getUser()->hasRole('ROLE_SUPER_ADMIN')) {
            unset($actions['delete']);
        }

        return $actions;
    }

    /**
     * Hook prePersist event to set media in a child form.
     *
     * @param Media $media
     *
     */
    public function prePersist($media)
    {
        $this->manageFileUpload($media);
        if (!$media->getPublic()) {
            $media->setAuthor($this->getUser());
        } else {
            $media->setAuthor(null);
        }
        if (!$this->getUser()->hasRole('ROLE_ADMIN')) {
            $media->setAuthor($this->getUser())
            ->setPublic(false);
        }
    }

    /**
     *  Hook prePersist event to set media in a child form.
     *
     * @param Media $media
     *
     */
    public function preUpdate($media)
    {
        $this->manageFileUpload($media);
    }

    /**
     * Configure admin form.
     *
     * @param FormMapper $formMapper
     *
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', TextType::class, [
                'label' => 'Titre du média',
                'required' => true,
            ])
            ->add('altText', TextType::class, [
                'label' => 'Texte de la balise alt',
                'required' => true,
            ]);
        if ($this->getUser()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper->add('public', CheckboxType::class, [
                'label' => 'Rendre l\'image publique',
                'required' => false
            ]);
        }
        if ($this->isCurrentRoute('edit')) {
            $formMapper
            ->add('file', FileType::class, [
                'label' => 'Choisissez votre fichier',
                'required' => false,
                'attr' => [
                    'accept' => "image/jpeg, image/jpg, image/pjpeg, image/png, image/x-png"
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/pjpeg',
                            'image/png',
                            'image/x-png',
                        ],
                        'mimeTypesMessage' => 'Please upload an image file',
                    ])
                ]
            ]);
        } else {
            $formMapper
            ->add('file', FileType::class, [
                'label' => 'Choisissez votre fichier',
                'required' => true,
                'attr' => [
                    'accept' => "image/jpeg, image/jpg, image/pjpeg, image/png, image/x-png"
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/pjpeg',
                            'image/png',
                            'image/x-png',
                        ],
                        'mimeTypesMessage' => 'Please upload an image file',
                    ])
                ]
            ]);
        }
    }

    /**
     * Configure filter used on list view.
     *
     * @param DatagridMapper $datagridMapper
     *
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, [
                'label' => 'Nom du fichier',
            ]);
    }

    /**
     * Configure field dysplay on list view.
     *
     * @param ListMapper $listMapper
     *
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('thumb', null, [
                'label' => 'Miniature',
                'template' => 'AppBundle/MediaAdmin/thumbnail.html.twig'
            ])
            ->add('title', null, [
                'label' => 'Titre',
            ]);
        if ($this->getUser()->hasRole('ROLE_SUPER_ADMIN')) {
            $listMapper->add('public', null, [
                'label' => 'Publique'
            ]);
        }
        $listMapper->add('_action', null, [
            'actions' => [
                'edit' => [],
                'delete' => [],
            ]
        ]);
    }

    /**
     * Used by sonata bundle to upload file.
     *
     * @param Media $media
     *
     */
    private function manageFileUpload($media)
    {
        $uploadedFile = $this->getForm()->get('file')->getData();

        $uploadableManager = $this->getConfigurationPool()
                                ->getContainer()
                                ->get('stof_doctrine_extensions.uploadable.manager');

        $media->setFile($uploadedFile);

        if ($media->getFile() instanceof UploadedFile) {
            $uploadableManager->markEntityToUpload($media, $media->getFile());
        }
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->where($query->expr()->eq($query->getRootAliases()[0] . '.author', ':userId'));
        $query->orWhere($query->expr()->andX(
            $query->expr()->isNull($query->getRootAliases()[0] . '.author'),
            $query->expr()->eq($query->getRootAliases()[0] . '.public', true)
        ));
        $query->setParameter('userId', $this->getUser()->getId());
        return $query;
    }

    private function getUser()
    {
        $tokenStorage = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken();
        return ($tokenStorage) ? $tokenStorage->getUser() : null;
    }
}
