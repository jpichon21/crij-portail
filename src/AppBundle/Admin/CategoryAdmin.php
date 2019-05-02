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
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ColorType;

/**
 * Category Admin class
 */
final class CategoryAdmin extends AbstractAdmin
{
    /**
     * Configure admin form.
     *
     * @param FormMapper $formMapper
     *
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab($this->trans('Configuration'))
                ->add('published', CheckboxType::class, [
                    'label' => 'Publier',
                    'required' => false,
                ])
                ->add('title', TextType::class, [
                    'label' => 'Titre',
                ])
                ->add('intro', SimpleFormatterType::class, [
                    'format' => 'richtml',
                    'attr' => [
                        'class' => 'ckeditor'
                    ],
                    'label' => 'Introduction',
                ])
                ->add('footer', SimpleFormatterType::class, [
                    'format' => 'richtml',
                    'label' => 'Pied de page',
                    'attr' => [
                        'class' => 'ckeditor'
                    ]
                ])
                ->add('color', ColorType::class, [
                    'label' => 'Couleur',
                ]);
        if ($this->isCurrentRoute('edit')) {
            $formMapper
            ->add('slug', TextType::class, [
                'label' => 'Chemin d\'accès',
            ]);
        }
                $formMapper
            ->end()
            ->end()
            ->tab('Métadonnées')
                ->add('link', TextType::class, [
                    'label' => 'Lien',
                    'required' => false,
                ])
                ->add('domain', TextType::class, [
                    'label' => 'Nom de domaine',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Média')
                ->add('logo', ModelListType::class, [
                    'label' => 'Logo',
                    'required' => false,
                    'btn_list' => true,
                ]);
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
                'label' => 'Titre des catégories',
            ])
            ->add('published', null, [
                'label' => 'Publiée'
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
            ->add('published', null, [
                'editable' => true,
                'label' => 'Publiée'
            ])
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ]
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->tab('General') // the tab call is optional
                ->add('title')
            ->end()
        ;
    }
}
