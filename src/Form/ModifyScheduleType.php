<?php

namespace App\Form;

use App\Entity\Mood;
use App\Entity\Schedule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifyScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start_day', null, [
                'widget' => 'single_text',
            ])
            ->add('end_day', null, [
                'widget' => 'single_text',
            ])
            ->add('recurrence')
            ->add('start_hour', null, [
                'widget' => 'single_text',
            ])
            ->add('end_hour', null, [
                'widget' => 'single_text',
            ])
            ->add('label')
            /* ->add('user_id') */
            ->add('mood_id', EntityType::class, [
                'class' => Mood::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Schedule::class,
        ]);
    }
}
