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
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Sonata\DoctrineORMAdminBundle\Filter\DateTimeRangeFilter;

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
                ]);
        if ($this->getUser()->allowedToPublish()) {
            $formMapper
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
            ]);
        }
            $formMapper
            ->end()
            ->end()
            ->tab('Média')
                ->add('background', ModelListType::class, [
                    'label' => 'Arrière-plan',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Publier dans')
                ->add('section', EntityType::class, [
                    'class' => Section::class,
                    'label' => 'Rubrique',
                    'required' => false,
                ])
                ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'label' => 'Catégorie',
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
            ])
            ->add('published', DateTimeRangeFilter::class, [
                'label' => 'Date de publication',
                'field_type' => 'sonata_type_datetime_range_picker',
            ])
            ->add('unpublished', DateTimeRangeFilter::class, [
                'label' => 'Date de dépublication',
                'field_type' => 'sonata_type_datetime_range_picker'
            ])
            ->add('archived', DateTimeRangeFilter::class, [
                'label' => 'Date de d\'archivage',
                'field_type' => 'sonata_type_datetime_range_picker'
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
            ->add('section', null, [
                'label' => 'Sous-Rubrique',
            ])
            ->add('published', 'datetime', [
                'label' => 'Date de publication',
                'format' => 'd/m/Y H:i',
            ])
            ->add('unpublished', 'datetime', [
                'label' => 'Date de dépublication',
                'format' => 'd/m/Y H:i',
            ])
            ->add('archived', 'datetime', [
                'label' => 'Date de d\'archivage',
                'format' => 'd/m/Y H:i',
            ])
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
