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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Section;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\AdminBundle\Form\Type\ModelType;

/**
 * News Admin class
 */
final class NewsAdmin extends AbstractAdmin
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
                ->add('introduction', TextareaType::class, [
                    'label' => 'Introduction',
                    'required' => false,
                ])
                ->add('content', TextareaType::class, [
                    'label' => 'Contenu',
                    'required' => false,
                ])
                ->add('archived', DateType::class, [
                    'label' => 'Date d\'archivage',
                    'widget' => 'choice',
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
