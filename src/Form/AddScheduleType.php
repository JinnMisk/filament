<?php

namespace App\Form;

use App\Entity\Mood;
use App\Entity\Schedule;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AddScheduleType extends AbstractType
{
    private Security $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

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
            ->add('mood_id', EntityType::class, [
                'class' => Mood::class,
                'choice_label' => 'label',
                'query_builder' => function(EntityRepository $entityRepository) {
                    $query_builder = $entityRepository->createQueryBuilder('mood');
                    return $query_builder
                    ->where($query_builder->expr()->eq('mood.user_id', '?1'))
                    ->setParameter('1', $this->security->getUser()->getId())
                    ->orderBy('mood.label', 'ASC')
                    ;
                }
            ])
/*             ->add('user_id') */;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Schedule::class,
        ]);
    }
}
