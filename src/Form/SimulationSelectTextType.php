<?php


namespace App\Form;


use App\Repository\SimulationRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class SimulationSelectTextType extends AbstractType
{
    private $simulationRepository;
    private $router;

    public function __construct(SimulationRepository $simulationRepository, RouterInterface $router)
    {
        $this->simulationRepository = $simulationRepository;
        $this->router = $router;
    }

    public function getParent()
    {
        return TextType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'invalid_message' => 'Simulation not found!',
            'attr' => [
                'class' => 'js_simulation_autocomplete',
                'data-autocomplete-url' => $this->router->generate("app_utility_simulations")
            ],

        ]);
    }
}