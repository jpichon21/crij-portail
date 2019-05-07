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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Form\FilterType;
use AppBundle\Form\PublicFilterType;

/**
 * Query Admin class
 */
final class QueryAdmin extends AbstractAdmin
{
    public function prePersist($query)
    {
        $this->preUpdate($query);
    }
    public function preUpdate($query)
    {
        $entity = $this->getSubject()->getEntity();
        foreach ($query->getFilters() as $filter) {
            if (!in_array(
                $filter['field'],
                $this->getConfigurationPool()->getContainer()->getParameter('entityField')[$entity]
            )
            ) {
                $query->setFilters(null);
            }
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
        if ($this->getSubject() !== null) {
            if ($this->getSubject()->getEntity() !== null) {
                $entity = $this->getSubject()->getEntity();
                $display = true;
            } else {
                $entity ='organism';
                $display = false;
            }
        } else {
            $entity ='organism';
            $display = false;
        }
        $keys = $this->keyImplode(
            ',',
            $this->getConfigurationPool()
            ->getContainer()
            ->getParameter('entityField')[$entity]
        );
        $fields = implode(
            ',',
            $this->getConfigurationPool()
            ->getContainer()
            ->getParameter('entityField')[$entity]
        );
        $formMapper
            ->add('name', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type de requête',
                'choices' => [
                    'AND' => 'AND',
                    'OR' => 'OR',
                ],
            ])
            ->add('entity', ChoiceType::class, [
                'label' => 'Table à interroger',
                'choices' => $this->getConfigurationPool()->getContainer()->getParameter('entity'),
            ])
            ->end()
            ->end();
        if ($display) {
            $formMapper
            ->with('Configurations des filtres', ['class' => 'col-md-6'])
                ->add('filters', CollectionType::class, [
                    'label' => false,
                    'entry_type'   => FilterType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'entry_options' => [
                        'attr' => [
                            'keys' => $keys,
                            'fields' => $fields,
                        ],
                    ],
                    ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                    ])
            ->end()
            ->end()
            ->with('Configurations des filtres publique', ['class' => 'col-md-6'])
                ->add('publicFilters', CollectionType::class, [
                    'label' => false,
                    'entry_type'   => PublicFilterType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'entry_options' => [
                        'attr' => [
                            'keys' => $keys,
                            'fields' => $fields,
                        ],
                    ],
                    ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                    ]);
        }
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
            ->add('name', null, [
                'label' => 'Nom',
            ])
            ->add('description', null, [
                'label' => 'Description',
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
            ->add('name', null, [
                'label' => 'Nom',
            ])
            ->add('description', null, [
                'label' => 'Description',
            ])
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ]
            ]);
    }

    private function keyImplode($glue, $array)
    {
        $result = "";
        foreach ($array as $key => $value) {
            $result .= $key . $glue;
        }
        return substr($result, 0, -1);
    }
}
