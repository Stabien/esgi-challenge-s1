<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class UserIbanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', NumberType::class, [
                'mapped' => false,
                'constraints' => [
                    new Constraints\Callback([$this, 'validateAmount'])
                ]
            ])
            ->add('iban', null, [
                'constraints' => [
                    new Constraints\NotBlank()
                ]
            ])
            ->add('saveIban', CheckboxType::class, [
                'mapped' => false,
                'label'    => 'Save this IBAN ',
                'required' => false,
            ])
            ->add('save', SubmitType::class, [
              'attr' => ['class' => 'save btn'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    public function validateAmount($value, ExecutionContextInterface $context)
    {
        $form = $context->getRoot();
        $amount = $form['amount']->getData();

        if (strlen($amount) == 0 || $amount < 1 || $amount > 99999) {
            $context->buildViolation('Amount should be minimum 1 and maximum your balance or 99 999')
                ->atPath('amount')
                ->addViolation();
        }
    }
}
