<?php

namespace App\Form;

use App\Entity\Simulation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimulationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        var session = maSession;
//        if session == null {
//            databaseSim = db.getSim
//        }
//        var income = session('income');


        $session = "new Session()";
        //$name = '';

        //dump($session->isStarted());

        //if ($session->isStarted()) { //todo session n'est pas toujours started. Trouver un moyen de la demarrer

        //    /** @var Simulation $simulation */
        //    $simulation = $session->get('simulation');

        //    $name = $simulation->getName();
        //}

        ///** @var Simulation $simulation */
        //$simulation = $session->get('simulation', "");

        //if ($simulation != ""){
          //  $name = $simulation->getName();
        //}

        $builder
            ->add('name', SimulationSelectTextType::class, [
                'required' => true,
                //'data' => income.name == null ? 'nom par défault' : income.name, //TODO to change
                'help' => 'Choisissez un nom pour votre nouvelle simulation',
                'attr' => array(
                    'placeholder' => 'Choisissez un nom pour votre nouvelle simulation'),
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
