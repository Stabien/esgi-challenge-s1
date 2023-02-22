<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\GreaterThan;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('email', EmailType::class)
            ->add('creditCardNumber')
            ->add('creditCardExpiration', DateType::class, [
                'constraints' => [
                    new GreaterThan(value: 'today', message: 'Your card has expired')
                ]
            ])
            ->add('creditCardSecret')
            ->add('password', PasswordType::class)
            ->add('roles')
            ->add('isVerified')
            ->add('balance')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
