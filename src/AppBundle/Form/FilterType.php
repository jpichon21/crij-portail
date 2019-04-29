<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fields = array_combine(
            explode(
                ',',
                $options['attr']['keys']
            ),
            explode(
                ',',
                $options['attr']['fields']
            )
        );
        $builder->add('field', ChoiceType::class, [
            'label' => 'Champs',
            'choices' => $fields,
        ]);
        $builder->add('value', TextType::class, [
            'label' => 'valeur à rechercher'
        ]);
    }
}
