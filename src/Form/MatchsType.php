<?php

namespace App\Form;

use App\Entity\Matchs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('bestOf')
            ->add('teamOneRating')
            ->add('teamTwoRating')
            ->add('teamOneScore')
            ->add('teamTwoScore')
            ->add('date')
            ->add('teamOne')
            ->add('teamTwo')
            ->add('teamWinner')
            ->add('competition')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matchs::class,
        ]);
    }
}
