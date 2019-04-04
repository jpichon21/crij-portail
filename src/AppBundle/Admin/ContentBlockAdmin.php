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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sonata\AdminBundle\Form\Type\ModelType;
use AppBundle\Entity\Content;

/**
 * ContentBlock Admin class
 */
final class ContentBlockAdmin extends AbstractAdmin
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
                ->add('type', ChoiceType::class, [
                    'label' => 'Type de sous_rubrique',
                    'choices' => [
                        'Type 1' => 'type_1',
                        'Type 2' => 'type_2',
                        'Type 3' => 'type_3',
                    ],
                ])
                ->add('text', TextareaType::class, [
                    'label' => 'Texte du contenu',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Requète')
                ->add('queries', ModelType::class, [
                    'multiple' => true,
                    'label' => 'Requète',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Sous-Rubrique')
                ->add('content', EntityType::class, [
                    'class' => Content::class,
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
            ->add('type', null, [
                'label' => 'Type',
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
            ->addIdentifier('type', null, [
                'label' => 'Type',
            ]);
    }
}
