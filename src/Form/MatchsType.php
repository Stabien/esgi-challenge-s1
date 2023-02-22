<?php

namespace App\Form;

use App\Entity\Matchs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('status', ChoiceType::class, [
                'Not started' => 0,
                'On going' => 1,
                'Ended' => 2,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matchs::class,
        ]);
    }
}
