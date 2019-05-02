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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Section;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelListType;

/**
 * Content Admin class
 */
final class ContentAdmin extends AbstractAdmin
{

    public function prePersist($content)
    {
        $this->preUpdate($content);
    }
    public function preUpdate($content)
    {
        foreach ($content->getContentBlocks() as $contentBlock) {
            $contentBlock->setContent($content);
        }
    }
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
                ->add('published', CheckboxType::class, [
                    'label' => 'Publier',
                    'required' => false,
                ])
                ->add('type', ChoiceType::class, [
                    'label' => 'Type de sous rubrique',
                    'choices' => [
                        'Type 1' => 'type_1',
                        'Type 2' => 'type_2',
                        'Type 3' => 'type_3',
                    ],
                ])
                ->add('title', TextType::class, [
                    'label' => 'Titre',
                    'required' => true
                ])
                ->add('intro', SimpleFormatterType::class, [
                    'label' => 'Introduction',
                    'format' => 'richtml',
                    'attr' => [
                        'class' => 'ckeditor'
                    ],
                ])
                ->add('section', EntityType::class, [
                    'class' => Section::class,
                    'label' => 'Rubrique',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Média')
                ->add('logo', ModelListType::class, [
                    'label' => 'Logo',
                    'required' => false,
                    'btn_list' => true
                ])
                ->add('background', ModelListType::class, [
                    'label' => 'Arrière-plan',
                    'required' => false,
                    'btn_list' => true
                ])
            ->end()
            ->end()
            ->tab('Contenus de la sous rubrique')
                ->add('contentBlocks', CollectionType::class, [
                    'label' => false,
                    'by_reference' => false,
                    'type_options' => [
                        'delete' => true,
                    ],
                ], [
                    'edit' => 'inline',
                    'inline' => 'natural',
                    'sortable' => 'position',
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
                'label' => 'Titre de la rubrique',
            ])
            ->add('section', null, [
                'label' => 'Rubrique',
            ])
            ->add('published', null, [
                'editable' => true,
                'label' => 'Publiée'
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
            ->add('title', null, [
                'label' => 'Titre',
            ])
            ->add('section', null, [
                'label' => 'Rubrique',
            ])
            ->add('published', null, [
                'editable' => true,
                'label' => 'Publiée'
            ])
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ]
            ]);
    }
}
