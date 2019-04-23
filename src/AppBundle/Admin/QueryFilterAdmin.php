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
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * QueryFilter Admin class
 */
final class QueryFilterAdmin extends AbstractAdmin
{
   
    /**
     * Configure admin form.
     *
     * @param FormMapper $formMapper
     *
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $this->arrayOfFields = $this->getConfigurationPool()->getContainer()->getParameter('entityField');
        $formMapper
            ->tab('Configuration')
                ->add('name', TextType::class, [
                    'label' => 'nom du filtre',
                ])
                ->add('description', TextType::class, [
                    'label' => 'description du filtre',
                ])
                ->add('entity', ChoiceType::class, [
                    'label' => 'table à interroger',
                    'choices' => $this->getConfigurationPool()->getContainer()->getParameter('entity'),
                ])
                ->add('field', ChoiceType::class, [
                    'label' => 'champs à filtrer',
                    'choices' => $this->arrayOfFields,
                    'attr' => [
                        'disabled' => 'disabled',
                    ],
                ])
                ->add('value', TextType::class, [
                    'label' => 'Valeur à chercher',
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
            ->add('entity', null, [
                'label' => 'Entité',
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
                'label' => 'Name',
            ])
            ->add('description', null, [
                'label' => 'Description',
            ]);
    }
}
