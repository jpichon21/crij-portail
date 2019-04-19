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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Section;
use Sonata\Form\Type\DateTimePickerType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;

/**
 * Article Admin class
 */
final class ArticleAdmin extends AbstractAdmin
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
            ->tab('Configuration')
                ->add('title', TextType::class, [
                    'label' => 'Titre',
                ])
                ->add('introduction', SimpleFormatterType::class, [
                    'label' => 'Introduction',
                    'required' => false,
                    'format' => 'richtml',
                    'attr' => [
                        'class' => 'ckeditor'
                    ],
                ])
                ->add('content', SimpleFormatterType::class, [
                    'label' => 'Contenu',
                    'required' => false,
                    'format' => 'richtml',
                    'attr' => [
                        'class' => 'ckeditor'
                    ],
                ])
                ->add('published', DateTimePickerType::class, [
                    'label' => 'Date de publication',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_use_seconds'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
                ->add('unpublished', DateTimePickerType::class, [
                    'label' => 'Date de dépublication',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_use_seconds'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
                ->add('archived', DateTimePickerType::class, [
                    'label' => 'Date d\'archivage',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_use_seconds'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Média')
                ->add('background', ModelType::class, [
                    'label' => 'Arrière-plan',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Sous-Rubrique')
                ->add('section', EntityType::class, [
                    'class' => Section::class,
                    'label' => 'Sous-Rubrique',
                    'required' => false,
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
                    'label' => 'Titre',
            ])
            ->add('section', null, [
                'label' => 'Sous-Rubrique',
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
            ->addIdentifier('title', null, [
                    'label' => 'Titre',
            ]);
    }
}
