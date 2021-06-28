<?php

namespace App\Form;

use App\Entity\Turnover;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TurnoverFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('month_worked', NumberType::class, [
                'label' => 'Nombre de mois travaillés par année',
            ])
            ->add('days_worked', NumberType::class, [
                'label' => 'Nombre de jours travaillés par mois',
            ])
            ->add('daily_revenue', MoneyType::class, [
                'help' => 'Valeur en euros par jour (tout service confondu)',
                'label' => 'Chiffre d\'affaire journalier',
            ])
            ->add('turnover_increase', PercentType::class, [
                'help' => 'Pourcentage d\'augmentation moyen du chiffre d\'affaire pour l\'année suivante (exemple: 10 pour 10%)',
                'type' => 'integer',
                'label' => 'Augmentation du chiffre d\'affaire',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Turnover::class,
        ]);
    }
}
