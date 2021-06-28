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
                'label' => 'Prêt(s) bancaire(s)',
            ])
            ->add('personnal_contribution', MoneyType::class, [
                'help' => 'Valeur en euros',
                'label' => 'Apport financier personnel',
            ])
            ->add('contribution_in_kind', MoneyType::class, [
                'help' => 'Valeur en euros',
                'label' => 'Apport en nature',
            ])
            ->add('starting_grant', MoneyType::class, [
                'help' => 'Valeur en euros',
                'label' => 'Subventions',
            ])
            ->add('others_incomes', MoneyType::class, [
                'help' => 'Valeur en euros',
                'label' => 'Autres revenus initial',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Incomes::class,
        ]);
    }
}
