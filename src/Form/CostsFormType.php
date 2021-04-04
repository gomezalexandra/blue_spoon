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
            ])
            ->add('salaries_increase', PercentType::class, [
                'help' => 'Pourcentage d\'augmentation moyen pour l\'année suivante (exemple: 10 pour 10%)',
                'type' => 'integer',
            ])
            ->add('rent', MoneyType::class, [
                'help' => 'Valeur en euros',
            ])
            ->add('insurance', MoneyType::class, [
                'help' => 'Valeur en euros',
            ])
            ->add('others_fixed_costs', MoneyType::class, [
                'help' => 'Valeur en euros',
            ])
            ->add('variable_costs', MoneyType::class, [
                'help' => 'Valeur en euros',
            ])
            ->add('taxes', MoneyType::class, [
                'help' => 'Valeur en euros',
            ])
            ->add('corporation_tax', MoneyType::class, [
                'help' => 'Valeur en euros',
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
