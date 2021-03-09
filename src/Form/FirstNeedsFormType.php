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
//        $session = new Session();
//        $startingCash = 0;
//        $starting_investment = 0;
//        $depreciation = 0;
//        $starting_stock = 0;
//        $others_needs = 0;
//
//        if ($session->isStarted()) {
//            /** @var FirstNeeds $firstNeeds */
//            $firstNeeds = $session->get('firstNeeds');
//
//            $startingCash = $firstNeeds->getStartingCash();
//            $starting_investment = $firstNeeds->getStartingInvestment();
//            $depreciation = $firstNeeds->getDepreciation();
//            $starting_stock = $firstNeeds->getStartingStock();
//            $others_needs = $firstNeeds->getOthersNeeds();
//        }

        $builder
            ->add('starting_cash', MoneyType::class, [
                'help' => 'Valeur en euros',

            ])
            ->add('starting_investment', MoneyType::class, [
                'help' => 'Valeur en euros',

            ])
            ->add('depreciation', PercentType::class, [
                'help' => 'Pourcentage de dépréciation moyenne annuelle des investissements (exemple: 10 pour 10% par an)',

            ])
            ->add('starting_stock', MoneyType::class, [
                'help' => 'Valeur en euros',

            ])
            ->add('others_needs', MoneyType::class, [
                'help' => 'Valeur en euros',

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
