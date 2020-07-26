<?php

namespace App\Form;

use App\Entity\Turnover;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TurnoverFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('month_worked')
            ->add('days_worked')
            ->add('daily_revenue')
            ->add('turnover_increase')
            //->add('simulation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Turnover::class,
        ]);
    }
}
