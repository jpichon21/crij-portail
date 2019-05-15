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

/**
 * Media Admin class
 */
final class MediaAdmin extends AbstractAdmin
{

    /**
     * Hook prePersist event to set media in a child form.
     *
     * @param Media $media
     *
     */
    public function prePersist($media)
    {
        $this->manageFileUpload($media);
        $media->setAuthor($this->getUser());
        $media->setPublic(false);
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
        if ($this->isCurrentRoute('edit')) {
            $formMapper
            ->add('file', FileType::class, [
                'label' => 'Choisissez votre fichier',
                'required' => false,
            ]);
        } else {
            $formMapper
            ->add('file', FileType::class, [
                'label' => 'Choisissez votre fichier',
                'required' => true,
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
            ])
            ->add('_action', null, [
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
        $query->andWhere($query->expr()->eq($query->getRootAliases()[0] . '.author', ':userId'));
        $query->setParameter('userId', $this->getUser()->getId());
        return $query;
    }

    private function getUser()
    {
        return $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
    }
}
