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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Category;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\AdminBundle\Form\Type\ModelListType;

/**
 * Section Admin class
 */
final class SectionAdmin extends AbstractAdmin
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
     * Hook prePersist event
     *
     * @param Section $section
     *
     */
    public function prePersist($section)
    {
        $this->preUpdate($section);
    }

    /**
     *  Hook prePersist event
     *
     * @param Section $section
     *
     */
    public function preUpdate($section)
    {
        if (!$this->getUser()->allowedToPublish()) {
            $section->setPublished(false);
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
            ->tab('Configuration');
        if ($this->getUser()->allowedToPublish()) {
            $formMapper
            ->add('published', CheckboxType::class, [
                'label' => 'Publier',
                'required' => false,
            ]);
        }
                $formMapper
                    ->add('title', TextType::class, [
                        'label' => 'Titre',
                    ])
                    ->add('intro', SimpleFormatterType::class, [
                        'label' => 'Introduction',
                        'format' => 'richtml',
                        'attr' => [
                            'class' => 'ckeditor'
                        ],
                    ])
                    ->add('color', ColorType::class, [
                        'label' => 'Couleur',
                    ])
                ->end()
                ->with('Cat??gorie', ['class' => 'col-md-6'])
                    ->add('category', EntityType::class, [
                        'class' => Category::class,
                        'label' => 'Cat??gorie',
                        'required' => true,
                    ])
                ->end();
        if ($this->isCurrentRoute('edit')) {
            $formMapper
            ->with('Chemin d\'acc??s', ['class' => 'col-md-6'])
                ->add('slug', TextType::class, [
                    'label' => 'Chemin d\'acc??s',
                    'sonata_help' => 'Attention, veuillez v??rifier que ce chemin d\'acc??s est bien unique',
                    'required' => false,
                ])
            ->end();
        }
            $formMapper
            ->end()
            ->tab('M??tadonn??e')
                ->add('link', TextType::class, [
                    'label' => 'Lien',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('M??dia')
                ->add('background', ModelListType::class, [
                    'label' => 'Arri??re-plan',
                    'required' => false,
                    'btn_list' => true
                ], [
                    'admin_code' => 'app.admin.media'
                ])
                ->add('thumb', ModelListType::class, [
                    'label' => 'Miniature',
                    'required' => false,
                    'btn_list' => true
                ], [
                    'admin_code' => 'app.admin.media'
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
            ->add('title', null, [
                    'label' => 'Titre',
            ])
            ->add('published', null, [
                'editable' => true,
                'label' => 'Publi??e'
            ])
            ->add('category', null, [
                'label' => 'Cat??gorie',
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
            ->add('category', null, [
                'label' => 'Cat??gorie',
            ]);
        if ($this->hasAccess('publish')) {
            $listMapper
            ->add('published', null, [
                'editable' => true,
                'label' => 'Publi??e'
            ]);
        } else {
            $listMapper
            ->add('published', null, [
                'label' => 'Publi??e'
            ]);
        }
            $listMapper
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
