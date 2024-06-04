<?php

namespace App\Form;

use App\Entity\Bulb;
use App\Entity\Mood;
use App\Entity\Model;
use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

class ModifyBulbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')
            ->add('room_label')
            /* ->add('is_on') */
            /* ->add('status') */
            ->add('color', ColorType::class, [
                'attr' => ['class' => 'tinymce'],
            ])
            ->add('luminosity', RangeType::class, [
            'attr' => [
                'min' => 0,
                'max' => 100
            ],
            ])
            /* ->add('hours') */
            ->add('wifi')
            ->add('model_id', EntityType::class, [
                'class' => Model::class,
                'choice_label' => 'id',
            ])
            ->add('mood_id', EntityType::class, [
                'class' => Mood::class,
                'choice_label' => 'id',
            ])
            ->add('place_id', EntityType::class, [
                'class' => Place::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bulb::class,
        ]);
    }
}
