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

class UserPaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', NumberType::class, [
                'mapped' => false,
                'constraints' => [
                    new Constraints\Callback([$this, 'validateAmount'])
                ],
                'label_attr' => ['class' => 'block text-start'],
                'attr' => ['class' => 'block rounded w-full'],

            ])
            ->add('creditCardNumber', null, [
                'constraints' => [
                    new Constraints\NotBlank()
                ],
                'label_attr' => ['class' => 'block text-start'],
                'attr' => ['class' => 'block'],
            ])
            ->add('creditCardExpiration', DateType::class, [
                'label_attr' => ['class' => 'block text-start'],
                'attr' => ['class' => 'block text-start'],
                'constraints' => [
                    new Constraints\NotBlank(),
                    new Constraints\GreaterThan(value: 'today', message: 'Your card has expired')
                ]
            ])
            ->add('creditCardSecret', null, [
                'constraints' => [
                    new Constraints\NotBlank()
                ],
                'label_attr' => ['class' => 'block text-start'],
                'attr' => ['class' => 'block']
                
            ])
            ->add('saveCreditCard', CheckboxType::class, [
                'mapped' => false,
                'label'    => 'Save this credit card ',
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
            $context->buildViolation('Amount should be minimum 1 and maximum 99 999')
                ->atPath('amount')
                ->addViolation();
        }
    }
}