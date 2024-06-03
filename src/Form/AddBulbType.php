<?php

namespace App\Form;

use App\Entity\Bulb;
use App\Entity\Model;
use App\Entity\Mood;
use App\Entity\Place;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddBulbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')
            ->add('room_label')
            ->add('is_on')
            ->add('status')
            ->add('color')
            ->add('luminosity')
            /* ->add('hours') */
            ->add('wifi')
            ->add('model_id', EntityType::class, [
                'class' => Model::class,
                'choice_label' => 'id',
            ])
            ->add('place_id', EntityType::class, [
                'class' => Place::class,
                'choice_label' => 'id',
            ])
            ->add('mood_id', EntityType::class, [
                'class' => Mood::class,
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
