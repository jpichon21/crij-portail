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

/**
 * Activity Admin class
 */
final class ActivityAdmin extends AbstractAdmin
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
                ->add('aidName', TextType::class, [
                    'label' => 'nom',
                ])
                ->add('description', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('degreeType', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('trainingName', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('degreeOption', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('degree', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('trainingMode', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('recruitMode', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('benefitType', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('lessonLevel', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('audienceType', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('specificAudience', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('conditions', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('serviceMission', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('publicInfo', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('recMode', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('destinations', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('period', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('cost', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('salary', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('serviceName', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('address', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('address2', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('zipCode', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('city', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('phone', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('tax', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('email', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('aidNature', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('regLocation', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('comment', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('contact', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('trainingDomain', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('partnership', TextType::class, [
                    'label' => '',
                    'required' => false,
                ])
                ->add('activityDomain', TextType::class, [
                    'label' => '',
                    'required' => false,
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
            ->add('aidName', null, [
                'label' => 'Nom',
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
            ->addIdentifier('aidName', null, [
                'label' => 'Nom',
            ]);
    }
}
