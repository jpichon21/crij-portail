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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

/**
 * Query Admin class
 */
final class OrganismAdmin extends AbstractAdmin
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
                ->add('name', TextType::class, [
                    'label' => 'Nom',
                ])
                ->add('initials', TextType::class, [
                    'label' => 'Initial',
                    'required' => false,
                ])
                ->add('name2', TextType::class, [
                    'label' => 'Deuxieme nom',
                    'required' => false,
                ])
                ->add('instGroup', TextType::class, [
                    'label' => 'Groupe',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Localisation')
                ->add('address', TextType::class, [
                    'label' => 'Adresse',
                    'required' => false,
                ])
                ->add('address2', TextType::class, [
                    'label' => 'Adresse Bis',
                    'required' => false,
                ])
                ->add('postalBox', TextType::class, [
                    'label' => 'Boite Postal',
                    'required' => false,
                ])
                ->add('poBox', TextType::class, [
                    'label' => 'PO BOX',
                    'required' => false,
                ])
                ->add('zipCode', TextType::class, [
                    'label' => 'Code Postal',
                    'required' => false,
                ])
                ->add('city', TextType::class, [
                    'label' => 'Ville',
                    'required' => false,
                ])
                ->add('OFZipCode', TextType::class, [
                    'label' => 'OFZipCode',
                    'required' => false,
                ])
                ->add('OFCity', TextType::class, [
                    'label' => 'OFCity',
                    'required' => false,
                ])
                ->add('cedex', TextType::class, [
                    'label' => 'cedex',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Contact')
                ->add('phone', TelType::class, [
                    'label' => 'Numéro de téléphone',
                    'required' => false,
                ])
                ->add('phone2', TelType::class, [
                    'label' => 'Numéro de téléphone 2',
                    'required' => false,
                ])
                ->add('fax', TelType::class, [
                    'label' => 'Numéro de fax',
                    'required' => false,
                ])
                ->add('email', EmailType::class, [
                    'label' => 'Adresse Email',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Localisation')
                ->add('url', IntegerType::class, [
                    'label' => 'URL',
                    'required' => false,
                ])
                ->add('department', IntegerType::class, [
                    'label' => 'Département',
                    'required' => false,
                ])
                ->add('academy', IntegerType::class, [
                    'label' => 'Académie',
                    'required' => false,
                ])
                ->add('region', IntegerType::class, [
                    'label' => 'Region',
                    'required' => false,
                ])
                ->add('country', IntegerType::class, [
                    'label' => 'Pays',
                    'required' => false,
                ])
            ->end()
            ->end()
            ->tab('Informations')
                ->add('recAddress', TextType::class, [
                    'label' => 'recAddress',
                    'required' => false,
                ])
                ->add('openHours', TextType::class, [
                    'label' => 'heures d\'ouvertures',
                    'required' => false,
                ])
                ->add('missions', TextType::class, [
                    'label' => 'missions',
                    'required' => false,
                ])
                ->add('type', IntegerType::class, [
                    'label' => 'Type',
                    'required' => false,
                ])
                ->add('netName', IntegerType::class, [
                    'label' => 'NetName',
                    'required' => false,
                ])
                ->add('netDescription', TextType::class, [
                    'label' => 'NetDescription',
                    'required' => false,
                ])
                ->add('agreement', TextType::class, [
                    'label' => 'Agréments',
                    'required' => false,
                ])
                ->add('skills', IntegerType::class, [
                    'label' => 'Compétences',
                    'required' => false,
                ])
                ->add('zone', TextType::class, [
                    'label' => 'Zone',
                    'required' => false,
                ])
                ->add('description', TextType::class, [
                    'label' => 'Description',
                    'required' => false,
                ])
                ->add('note', TextType::class, [
                    'label' => 'Note',
                    'required' => false,
                ])
                ->add('longitude', TextType::class, [
                    'label' => 'Longitude',
                    'required' => false,
                ])
                ->add('latitude', TextType::class, [
                    'label' => 'Latitude',
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
            ->add('name', null, [
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
            ->addIdentifier('name', null, [
                'label' => 'Nom',
            ]);
    }
}
