<?php


namespace App\Form;


use App\Entity\Search;
use App\Entity\Simulation;
use App\Repository\SimulationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    private $simulationRepository;

    public function __construct(SimulationRepository $simulationRepository)
    {
        $this->simulationRepository = $simulationRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', SimulationSelectTextType::class);

                /*EntityType::class, [
                'class' => Simulation::class,
                'choices' => $this->simulationRepository->findAll(),
                'choice_label' => function(Simulation $simulation) {
                    return sprintf('%s', $simulation->getName());
                },
                'placeholder' => 'Entrez un nom de simulation',

            ])*/

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'invalid_message' => 'Hmm, user not found!',
        ]);
    }
}