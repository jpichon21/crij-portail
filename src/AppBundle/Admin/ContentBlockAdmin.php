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
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\ContentBlock;

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
            ->add('type', ChoiceFieldMaskType::class, [
                'label' => 'Type de contenus',
                'choices' => ContentBlock::TYPE,
                'map' => [
                    'text' => ['text'],
                    'job_maps' => ['queries'],
                    'job_offers' => ['queries'],
                    'job_requests' => ['queries'],
                    'flora' => ['queries'],
                ],
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'required' => true,
            ])
            ->add('text', SimpleFormatterType::class, [
                'label' => 'Texte du contenu',
                'required' => false,
                'format' => 'richtml',
                'attr' => [
                    'class' => 'ckeditor'
                ],
            ])
            ->add('queries', ModelType::class, [
                'multiple' => true,
                'label' => 'Requète',
                'required' => false,
            ])
            ->add('position', 'hidden', [
                'attr' => [
                    "hidden" => true,
                ]
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
