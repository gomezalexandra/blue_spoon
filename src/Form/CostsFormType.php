<?php

namespace App\Form;

use App\Entity\Costs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CostsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('salaries', MoneyType::class, [
                'help' => 'Valeur en euros',
                'label' => 'Salaires',
            ])
            ->add('salaries_increase', PercentType::class, [
                'help' => 'Pourcentage d\'augmentation moyen pour l\'année suivante (exemple: 10 pour 10%)',
                'type' => 'integer',
                'label' => 'Hausse estimée des salaires',
            ])
            ->add('rent', MoneyType::class, [
                'help' => 'Valeur en euros',
                'label' => 'Loyer',
            ])
            ->add('insurance', MoneyType::class, [
                'help' => 'Valeur en euros',
                'label' => 'Assurances',
            ])
            ->add('others_fixed_costs', MoneyType::class, [
                'help' => 'Valeur en euros',
                'label' => 'Autres frais fixes',
            ])
            ->add('variable_costs', PercentType::class, [
                'help' => 'Valeur en euros',
                'type' => 'integer',
                'label' => 'Charges variables',
            ])
            ->add('corporation_tax', PercentType::class, [
                'help' => 'Valeur en pourcentage',
                'type' => 'integer',
                'label' => 'Impôt sur les sociétés',
            ])
            ->add('taxes', PercentType::class, [
                'help' => 'Valeur en pourcentage',
                'type' => 'integer',
                'label' => 'Autres taxes diverses',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Costs::class,
        ]);
    }
}
