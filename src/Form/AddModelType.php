<?php

namespace App\Form;

use App\Entity\Model;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('hours_max')
            ->add('name')
            ->add('default_color')
            ->add('default_luminosity')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Model::class,
        ]);
    }
}
