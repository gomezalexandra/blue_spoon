<?php

namespace App\Form;

use App\Entity\FirstNeeds;
use App\Entity\Simulation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FirstNeedsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('starting_cash', MoneyType::class, [
                'help' => 'Valeur en euros',
                'label' => 'Trésorerie de démarrage nécessaire',
            ])
            ->add('starting_investment', MoneyType::class, [
                'help' => 'Valeur en euros',
                'label' => 'Investissement initial nécessaire',

            ])
            ->add('depreciation', PercentType::class, [
                'help' => 'Pourcentage de dépréciation moyenne annuelle des investissements (exemple: 10 pour 10% par an)',
                'type' => 'integer',
                'label' => 'Dépréciation de l\'investissement',
            ])
            ->add('starting_stock', MoneyType::class, [
                'help' => 'Valeur en euros',
                'label' => 'Stock de démarrage nécessaire',

            ])
            ->add('others_needs', MoneyType::class, [
                'help' => 'Valeur en euros',
                'label' => 'Autres besoins de démarrage',

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FirstNeeds::class,
        ]);
    }
}
