<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email')
        ->add('plainPassword')
        ->add('name')
        ->add('consentName')
        ->add('lastName')
        ->add('consentLastName')
        ->add('birthdate', DateTimeType::class, ['format' => 'Y-m-dTH:i:sP', 'widget' => 'single_text'])
        ->add('gender')
        ->add('status')
        ->add('consentMail')
        ->add('address')
        ->add('zipcode')
        ->add('city')
        ->add('phone')
        ->add('usePhone')
        ->add('mobile')
        ->add('useMobile')
        ->add('consentTerms')
        ->add('consentNews');
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
            'csrf_protection' => false
        ));
    }
}
