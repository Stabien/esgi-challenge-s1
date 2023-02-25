<?php

namespace App\Form;

use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'mb-5', 'placeholder' => 'Team Name']
            ])
            ->add('logo', TextType::class, [
                'attr' => ['class' => 'mb-5', 'placeholder' => 'Nom logo sans -logo.png']
            ])
            ->add('region', TextType::class, [
                'attr' => ['class' => 'mb-5', 'placeholder' => 'Nom région']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}