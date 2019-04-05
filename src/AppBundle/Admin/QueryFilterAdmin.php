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
                ->add('entity', ChoiceType::class, [
                    'choices' => $this->getConfigurationPool()->getContainer()->getParameter('entity'),
                ])
                ->add('field', ChoiceType::class, [
                    'label' => 'field',
                    'choices' => $this->arrayOfFields
                ])
                ->add('value', TextType::class, [
                    'label' => 'Value',
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
            ->addIdentifier('entity', null, [
                'label' => 'Entité',
            ]);
    }
}
