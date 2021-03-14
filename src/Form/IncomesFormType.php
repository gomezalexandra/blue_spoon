<?php

namespace App\Form;

use App\Entity\Incomes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IncomesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bank_loan')
            ->add('personnal_contribution')
            ->add('contribution_in_kind')
            ->add('starting_grant')
            ->add('others_incomes');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Incomes::class,
        ]);
    }
}
