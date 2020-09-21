<?php

namespace App\Form;

use App\Entity\Simulation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimulationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', SimulationSelectTextType::class, [
                'help' => 'Choose something catchy!',
                'required' => false,
            ])
            /*->add('created_at')
            ->add('state')
            ->add('user_id')
            ->add('firstNeeds')
            ->add('incomes')
            ->add('turnover')
            ->add('costs')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Simulation::class,
        ]);
    }
}
