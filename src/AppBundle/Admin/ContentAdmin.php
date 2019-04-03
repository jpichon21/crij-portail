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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Section;

/**
 * Content Admin class
 */
final class ContentAdmin extends AbstractAdmin
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
                ->add('intro', TextareaType::class, [
                    'label' => 'Introduction',
                ])
            ->end()
            ->end()
            ->tab('Média')
                ->add('logo', ModelType::class, [
                    'label' => 'Logo',
                    'required' => false,
                ])
                ->add('background', ModelType::class, [
                    'label' => 'Arriére-Plan',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Rubrique')
                ->add('section', EntityType::class, [
                    'class' => Section::class,
                    'label' => 'section',
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
            ->add('intro', null, [
                'label' => 'Introduction',
            ])
            ->add('section', null, [
                'label' => 'Rubrique',
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
            ->addIdentifier('intro', null, [
                'label' => 'Introduction',
            ]);
    }
}
