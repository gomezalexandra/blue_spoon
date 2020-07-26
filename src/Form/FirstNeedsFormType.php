<?php

namespace App\Form;

use App\Entity\FirstNeeds;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FirstNeedsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('starting_cash')
            ->add('starting_investment')
            ->add('depreciation')
            ->add('starting_stock')
            ->add('others_needs')
            //->add('simulation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FirstNeeds::class,
        ]);
    }
}
