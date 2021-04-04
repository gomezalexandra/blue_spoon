<?php

namespace App\Form;

use App\Entity\Incomes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IncomesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bank_loan', MoneyType::class, [
                'help' => 'Valeur en euros',
            ])
            ->add('personnal_contribution', MoneyType::class, [
                'help' => 'Valeur en euros',
            ])
            ->add('contribution_in_kind', MoneyType::class, [
                'help' => 'Valeur en euros',
            ])
            ->add('starting_grant', MoneyType::class, [
                'help' => 'Valeur en euros',
            ])
            ->add('others_incomes', MoneyType::class, [
                'help' => 'Valeur en euros',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Incomes::class,
        ]);
    }
}
