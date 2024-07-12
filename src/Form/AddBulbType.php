<?php

namespace App\Form;

use App\Entity\Bulb;
use App\Entity\Mood;
use App\Entity\Model;
use App\Entity\Place;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

class AddBulbType extends AbstractType
{
    private Security $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {/*  */
        $builder
            ->add('label')
            ->add('room_label')
            ->add('is_on', CheckboxType::class, [
                'label'    => 'Souhaitez-vous allumer l\'ampoule ?',
                'required' => false,
            ])
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
            ->add('wifi')
            ->add('model_id', EntityType::class, [
                'class' => Model::class,
                'choice_label' => 'name',
            ])
            ->add('place_id', EntityType::class, [
                'class' => Place::class,
                'choice_label' => 'label',
                'query_builder' => function(EntityRepository $entityRepository) {
                    $query_builder = $entityRepository->createQueryBuilder('place');
                    return $query_builder
                    ->where($query_builder->expr()->eq('place.user_id', '?1'))
                    ->setParameter('1', $this->security->getUser()->getId())
                    ->orderBy('place.label', 'ASC')
                    ;
                }
            ])
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
            /*          ->add('is_on')
            ->add('status')
            ->add('hours') */;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bulb::class,
        ]);
    }
}