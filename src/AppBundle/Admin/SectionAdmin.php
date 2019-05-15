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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Category;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\AdminBundle\Form\Type\ModelListType;

/**
 * Section Admin class
 */
final class SectionAdmin extends AbstractAdmin
{
    /**
     * Hook prePersist event
     *
     * @param Section $section
     *
     */
    public function prePersist($section)
    {
        $this->preUpdate($section);
    }

    /**
     *  Hook prePersist event
     *
     * @param Section $section
     *
     */
    public function preUpdate($section)
    {
        if (!$this->getUser()->allowedToPublish()) {
            $section->setPublished(false);
        }
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
            ->tab('Configuration');
        if ($this->getUser()->allowedToPublish()) {
            $formMapper
            ->add('published', CheckboxType::class, [
                'label' => 'Publier',
                'required' => false,
            ]);
        }
                $formMapper
                    ->add('title', TextType::class, [
                        'label' => 'Titre',
                    ])
                    ->add('intro', SimpleFormatterType::class, [
                        'label' => 'Introduction',
                        'format' => 'richtml',
                        'attr' => [
                            'class' => 'ckeditor'
                        ],
                    ])
                    ->add('color', ColorType::class, [
                        'label' => 'Couleur',
                    ])
                ->end()
                ->with('Catégorie', ['class' => 'col-md-6'])
                    ->add('category', EntityType::class, [
                        'class' => Category::class,
                        'label' => 'Catégorie',
                        'required' => false,
                    ])
                ->end();
        if ($this->isCurrentRoute('edit')) {
            $formMapper
            ->with('Chemin d\'accès', ['class' => 'col-md-6'])
                ->add('slug', TextType::class, [
                    'label' => 'Chemin d\'accès',
                    'sonata_help' => 'Attention, veuillez vérifier que ce chemin d\'accès est bien unique',
                    'required' => false,
                ])
            ->end();
        }
            $formMapper
            ->end()
            ->tab('Métadonnée')
                ->add('link', TextType::class, [
                    'label' => 'Lien',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Média')
                ->add('background', ModelListType::class, [
                    'label' => 'Arrière-plan',
                    'required' => false,
                    'btn_list' => true
                ])
                ->add('thumb', ModelListType::class, [
                    'label' => 'Miniature',
                    'required' => false,
                    'btn_list' => true,
                ])
            ->end()
            ->end();
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
            ->add('title', null, [
                    'label' => 'Titre',
            ])
            ->add('published', null, [
                'editable' => true,
                'label' => 'Publiée'
            ])
            ->add('category', null, [
                'label' => 'Catégorie',
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
            ->add('title', null, [
                'label' => 'Titre',
            ])
            ->add('category', null, [
                'label' => 'Catégorie',
            ]);
        if ($this->hasAccess('publish')) {
            $listMapper
            ->add('published', null, [
                'editable' => true,
                'label' => 'Publiée'
            ]);
        } else {
            $listMapper
            ->add('published', null, [
                'label' => 'Publiée'
            ]);
        }
            $listMapper
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ]
            ]);
    }

    private function getUser()
    {
        return $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
    }
}
