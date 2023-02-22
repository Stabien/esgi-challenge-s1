<?php

namespace App\Form;

use App\Entity\Bet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints;

class BetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', NumberType::class, [
                'scale' => 2,
                'constraints' => [
                    new Constraints\Range(
                        min: 1,
                        max: 99999,
                        notInRangeMessage: 'You must bet minimum 1$ and maximum 99999$ and not exceed your balance'
                    )
                ]
            ])
            ->add('status')
            ->add('earnings')
            ->add('user')
            ->add('match')
            ->add('team')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bet::class,
        ]);
    }
}
