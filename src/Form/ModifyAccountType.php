<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifyAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            /*             ->add('roles') */
            /*             ->add('password') */
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Password',
                'mapped' => false,
                'required' => false,
            ])
            ->add('first_name')
            ->add('last_name')
            ->add('shipping_address_number')
            ->add('shipping_address_streetname')
            ->add('shipping_address_postalcode')
            ->add('shipping_address_complement')
            ->add('shipping_address_city')
            ->add('billing_address_number')
            ->add('billing_address_streetname')
            ->add('billing_address_postalcode')
            ->add('billing_address_complement')
            ->add('billing_address_city')
            ->add('phone_number')
            ->add('siret');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
