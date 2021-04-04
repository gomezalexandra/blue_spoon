<?php

namespace App\Form;

use App\Entity\Turnover;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TurnoverFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('month_worked')
            ->add('days_worked')
            ->add('daily_revenue', MoneyType::class, [
                'help' => 'Valeur en euros par jour (tout service confondu)',
            ])
            ->add('turnover_increase', PercentType::class, [
                'help' => 'Pourcentage d\'augmentation moyen du chiffre d\'affaire pour l\'année suivante (exemple: 10 pour 10%)',
                'type' => 'integer',
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
