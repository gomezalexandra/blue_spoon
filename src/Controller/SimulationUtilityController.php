<?php


namespace App\Controller;


use App\Repository\SimulationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class SimulationUtilityController extends AbstractController
{
    /**
     * @Route("/utility/simulations", methods="GET", name="app_utility_simulations")
     */
    public function getSimulationsApi(SimulationRepository $simulationRepository, Request $request)
    {
        $simulations = $simulationRepository->findAllSimulationsMatching($request->query->get('query'));

        return $this->json([
            'simulations' => $simulations
        ], 200, [],['groups' => ['main']]);
    }

}