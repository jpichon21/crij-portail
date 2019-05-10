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
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\ContentBlock;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\DoctrineORMAdminBundle\Filter\ChoiceFilter;

/**
 * ContentBlock Admin class
 */
final class ContentBlockAdmin extends AbstractAdmin
{
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        if (!$this->getUser()->hasRole('ROLE_SUPER_ADMIN')) {
            unset($actions['delete']);
        }

        return $actions;
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
            ->with('configuration')
                ->add('type', ChoiceFieldMaskType::class, [
                    'label' => 'Type de contenus',
                    'choices' => ContentBlock::TYPE,
                    'map' => [
                        'text' => ['text'],
                        'job_maps' => ['query'],
                        'job_offers' => ['query'],
                        'job_requests' => ['query'],
                        'flora' => ['query'],
                    ],
                ])
                ->add('title', TextType::class, [
                    'label' => 'Titre',
                    'required' => true,
                ])
            ->end()
            ->with('contenus')
                ->add('text', SimpleFormatterType::class, [
                    'label' => false,
                    'required' => false,
                    'format' => 'richtml',
                    'attr' => [
                        'class' => 'ckeditor'
                    ],
                ])
                ->add('query', ModelListType::class, [
                    'label' => 'Requêtes',
                    'by_reference' => false,
                    'btn_list' => true,
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
            ->add('content', null, [
                'label' => 'Sous-Rubrique'
            ])
            ->add('type', ChoiceFilter::class, [
                'label' => 'Type de Contenu',
                'field_options' => [
                    'choices' => ContentBlock::TYPE,
                    'required' => false,
                    'multiple' => true,
                    'expanded' => false,
                ],
                'field_type' => 'choice',
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
            ->add('type', null, [
                'label' => 'Type de Contenu',
                'template' => 'AppBundle/ContentBlockAdmin/trans_type.html.twig'
            ])
            ->add('content', null, [
                'label' => 'Sous-Rubrique'
            ])
            ->add('query', null, [
                'label' => 'Requête'
            ])
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ]
            ]);
    }
    private function getUser()
    {
        return $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
    }
}
