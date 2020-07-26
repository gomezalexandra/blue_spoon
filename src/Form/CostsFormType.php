<?php

namespace App\Form;

use App\Entity\Costs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CostsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('salaries')
            ->add('salaries_increase')
            ->add('rent')
            ->add('insurance')
            ->add('others_fixed_costs')
            ->add('variable_costs')
            ->add('taxes')
            ->add('corporation_tax')
           // ->add('simulation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Costs::class,
        ]);
    }
}
