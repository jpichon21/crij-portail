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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Query Admin class
 */
final class QueryAdmin extends AbstractAdmin
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
            ->tab('Identification')
                ->add('name', TextType::class, [
                    'label' => 'Nom',
                ])
                ->add('description', TextareaType::class, [
                    'label' => 'Description',
                ])
            ->end()
            ->end()
            ->tab('Configuration')
                ->add('type', ChoiceType::class, [
                    'label' => 'Type',
                    'choices' => [
                        'AND' => 'AND',
                        'OR' => 'OR',
                    ],
                ]);
                // ->add('filters', CollectionType::class, [
                //     'label' => 'Filtre',
                //     'required' => false,
                //     'type_options' => [
                //         'delete' => true,
                //     ],
                // ], [
                //     'edit' => 'inline',
                //     'inline' => 'table',
                // ]);
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
                'label' => 'Nom',
            ])
            ->add('description', null, [
                'label' => 'Description',
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
            ->addIdentifier('name', null, [
                'label' => 'Nom',
            ])
            ->add('description', null, [
                'label' => 'Description',
            ]);
    }
}
