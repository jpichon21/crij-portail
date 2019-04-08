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
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;

/**
 * Category Admin class
 */
final class CategoryAdmin extends AbstractAdmin
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
            ->tab($this->trans('Configuration'))
                ->add('title', TextType::class, [
                    'label' => 'Titre',
                ])
                ->add('intro', SimpleFormatterType::class, [
                    'format' => 'richtml',
                    'attr' => [
                        'class' => 'ckeditor'
                    ],
                    'label' => 'Introduction',
                ])
                ->add('footer', SimpleFormatterType::class, [
                    'format' => 'richtml',
                    'label' => 'Pied de page',
                    'attr' => [
                        'class' => 'ckeditor'
                    ]
                ]);
        if ($this->getSubject()->getTitle() !== null) {
            $formMapper
            ->add('slug', TextType::class, [
                'label' => 'Chemin d\'accès',
            ]);
        }
            $formMapper
            ->end()
            ->end()
            ->tab('Métadonnées')
                ->add('link', TextType::class, [
                    'label' => 'Lien',
                    'required' => false,
                ])
                ->add('domain', TextType::class, [
                    'label' => 'Nom de domaine',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Média')
                ->add('logo', ModelType::class, [
                    'label' => 'Logo',
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
