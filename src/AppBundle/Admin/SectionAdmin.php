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
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Category;

/**
 * Section Admin class
 */
final class SectionAdmin extends AbstractAdmin
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
                ->add('intro', TextareaType::class, [
                    'label' => 'Introduction',
                ])
                ->add('color', ColorType::class, [
                    'label' => 'Couleur',
                ])
            ->end()
            ->end()
            ->tab('Métadonnée')
                ->add('link', TextType::class, [
                    'label' => 'Lien',
                    'required' => false,
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
                ->add('thumb', ModelType::class, [
                    'label' => 'Miniature',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Catégorie')
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
            ->add('category', null, [
                'label' => 'Catégorie',
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
