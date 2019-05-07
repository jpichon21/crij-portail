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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use AppBundle\Entity\User as User;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Section Admin class
 */
final class UserAdmin extends AbstractAdmin
{
    public function prePersist($object)
    {
        $this->preUpdate($object);
    }

    public function preUpdate($object)
    {
        $plainPassword = $object->getPlainPassword();
        if ($plainPassword !== null) {
            $container = $this->getConfigurationPool()->getContainer();
            $encoder = $container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($object, $plainPassword);
        
            $object->setPassword($encoded);
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
            ->with('Gestion de l\'utilisateur')
                ->add('roles', ChoiceType::class, [
                    'label' => 'Roles',
                    'choices' => User::ROLES,
                    'multiple' => true,
                    'expanded' => true,
                    'attr' => ['style' => 'margin-bottom:30px;']
                ])
                ->add('enabled', CheckboxType::class, [
                    'label' => 'Utilisateur activé',
                    'required' => false
                    ])
            ->end()
            ->end()
            ->with('Identification', ['class' => 'col-md-6'])
                ->add('name', TextType::class, [
                    'label' => 'Nom',
                ])
                ->add('consentName', CheckboxType::class, [
                    'label' => 'Accepte de diffuser son nom',
                    'required' => false,
                ])
                ->add('lastName', TextType::class, [
                    'label' => 'Prénom',
                ])
                ->add('consentLastName', CheckboxType::class, [
                    'label' => 'Accepte de diffuser son prénom',
                    'required' => false,
                ])
                ->add('email', EmailType::class, [
                    'label' => 'Adresse Email',
                ])
                ->add('consentMail', CheckboxType::class, [
                    'label' => 'Accepte de diffuser son adresse email',
                    'required' => false,
                ])
                ->add('nickname', TextType::class, [
                    'label' => 'Pseudo',
                ]);
        if ($this->isCurrentRoute('edit')) {
            $formMapper
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répéter le mot de passe'],
                'required' => false
            ]);
        } else {
            $formMapper
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répéter le mot de passe'],
                'required' => true
            ]);
        }
                $formMapper
                ->add('birthdate', BirthdayType::class, [
                    'label' => 'Date de naissance',
                    'required' => true
                ])
                ->add('gender', ChoiceType::class, [
                    'label' => 'Sexe',
                    'choices' => [
                        'Homme' => 'male',
                        'Femme' => 'female'
                    ],
                    'expanded' => true,
                    'required' => true,
                ])
                ->add('status', ChoiceType::class, [
                    'label' => 'Statut',
                    'choices' => User::STATUT,
                    'required' => false,
                ])
            ->end()
            ->end()
            ->with('Adresse', ['class' => 'col-md-6'])
                ->add('address', TextareaType::class, [
                    'label' => 'Adresse',
                ])
                ->add('zipcode', TextType::class, [
                    'label' => 'Code Postal',
                ])
                ->add('city', TextType::class, [
                    'label' => 'Ville',
                ])
                ->add('department', TextType::class, [
                    'label' => 'Département',
                ])
            ->end()
            ->end()
            ->with('Téléphone', ['class' => 'col-md-6'])
                ->add('mobile', TelType::class, [
                    'label' => 'Tél. mobile'
                ])
                ->add('useMobile', CheckboxType::class, [
                    'label' => 'Souhaite utiliser ce numéro',
                    'required' => false,
                ])
                ->add('phone', TelType::class, [
                    'label' => 'Tél. fixe'
                ])
                ->add('usePhone', CheckboxType::class, [
                    'label' => 'Souhaite utiliser ce numéro',
                    'required' => false
                ])
            ->end()
            ->end()
            ->with('Conditions d\'utilisation', ['class' => 'col-md-6'])
                ->add('consentTerms', CheckboxType::class, [
                    'label' => 'J\'ai lu et j\'accepte les conditions d\'utilisation',
                    'required' => true
                ])
                ->add('consentNews', CheckboxType::class, [
                    'label' => 'Je souhaite recevoir la newsletter',
                    'required' => false
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
            ->add('email', null, [
                    'label' => 'Email',
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
            ->add('lastName', null, [
                'label' => 'Prénom',
            ])
            ->add('email', null, [
                'label' => 'Adresse Email',
            ])
            ->add('roles', null, [
                'label' => 'Roles',
                'template' => 'AppBundle/UserAdmin/trans_roles.html.twig'
            ])
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                    'show' => [],
                ]
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
        ->with('Droits')
            ->add('roles', null, [
                'label' => 'Roles',
                'template' => 'AppBundle/UserAdmin/trans_roles.html.twig'
            ])
        ->end()
        ->end()
        ->with('Identification', ['class' => 'col-md-6'])
            ->add('name', null, [
                'label' => 'Nom:',
            ])
            ->add('consentName', null, [
                'label' => 'Diffuse son nom:',
            ])
            ->add('lastName', null, [
                'label' => 'Prénom:',
            ])
            ->add('consentLastName', null, [
                'label' => 'Diffuse son prénom:',
            ])
            ->add('nickname', null, [
                'label' => 'Pseudo:',
            ])
            ->add('birthdate', 'datetime', [
                'label' => 'Date de naissance:',
                'format' => 'd/m/Y',
            ])
            ->add('gender', null, [
                'label' => 'Sexe:',
                'template' => 'AppBundle/UserAdmin/show_trans_gender.html.twig'
            ])
            ->add('status', null, [
                'label' => 'Statut:',
                'template' => 'AppBundle/UserAdmin/show_trans_status.html.twig'
            ])
            ->add('email', null, [
                'label' => 'Adresse Email:',
            ])
            ->add('consentMail', null, [
                'label' => 'Diffuse son mail:',
            ])
        ->end()
        ->end()
        ->with('Adresse', ['class' => 'col-md-6'])
            ->add('address', null, [
                'label' => 'Adresse:',
            ])
            ->add('zipcode', null, [
                'label' => 'Code Postal:',
            ])
            ->add('city', null, [
                'label' => 'Ville:',
            ])
            ->add('department', null, [
                'label' => 'Département:',
            ])
        ->end()
        ->end()
        ->with('Téléphone', ['class' => 'col-md-6'])
            ->add('mobile', null, [
                'label' => 'Tél. mobile:'
            ])
            ->add('useMobile', null, [
                'label' => 'Utilise ce numéro:',
            ])
            ->add('phone', null, [
                'label' => 'Tél. fixe:'
            ])
            ->add('usePhone', null, [
                'label' => 'Utilise ce numéro:',
            ])
        ->end()
        ->end()
        ->with('Conditions d\'utilisation', ['class' => 'col-md-6'])
            ->add('consentTerms', null, [
                'label' => 'Conditions d\'utilisation:',
            ])
            ->add('consentNews', null, [
                'label' => 'Newsletter:',
            ])
        ->end()
        ->end();
    }
}
