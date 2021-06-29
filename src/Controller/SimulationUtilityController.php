<?php


namespace App\Controller;


use App\Entity\User;
use App\Repository\SimulationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class SimulationUtilityController extends AbstractController
{
    /**
     * @Route("/utility/simulations", methods="GET", name="app_utility_simulations")
     */
    public function getSimulationsApi(SimulationRepository $simulationRepository, Request $request, EntityManagerInterface $em)
    {
        $user = $this->getUser();
        $emailUser = $user->getUsername();
        $userRepository = $em->getRepository(User::class);
        $userLogged = $userRepository->findBy(['email' => $emailUser]);
        $userId = $userLogged[0]->getId();

        $simulations = $simulationRepository->findAllSimulationsMatching($request->query->get('query'), $userId);

        return $this->json([
            'simulations' => $simulations
        ], 200, [],['groups' => ['main']]);
    }

}