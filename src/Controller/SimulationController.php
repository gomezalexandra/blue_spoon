<?php


namespace App\Controller;


use App\Entity\Costs;
use App\Entity\FirstNeeds;
use App\Entity\Incomes;
use App\Entity\Simulation;
use App\Entity\Turnover;
use App\Form\CostsFormType;
use App\Form\FirstNeedsFormType;
use App\Form\IncomesFormType;
use App\Form\SimulationFormType;
use App\Form\TurnoverFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SimulationController extends AbstractController
{
    /**
     * @Route("/new_simulation", name="app_new_simulation")
     */
    public function newSimulation(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(SimulationFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Simulation $simulation */
            $simulation = $form->getData();
            $session = $request->getSession();
            $session->set('simulation', $simulation);

            //  $this->addFlash();
            return $this->redirectToRoute('app_first_needs');
        }

        return $this->render('new_simulation.html.twig', [
            'simulationForm'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/first_needs", name="app_first_needs")
     */
    public function firstNeeds(EntityManagerInterface $em, Request $request)
    {
        if ($request->getSession()->get('simulation')) {
            $form = $this->createForm(FirstNeedsFormType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var FirstNeeds $firstNeeds */
                $firstNeeds = $form->getData();
                $session = $request->getSession();
                $session->set('firstNeeds', $firstNeeds);

                // $this->addFlash();
                return $this->redirectToRoute('app_turnover');
            }
            return $this->render('first_needs.html.twig', [
                'firstNeedsForm' => $form->createView(),
            ]);
        }
        return $this->redirectToRoute('app_new_simulation');
    }

    /**
     * @Route("/turnover", name="app_turnover")
     */
    public function turnover(EntityManagerInterface $em, Request $request)
    {
        if ($request->getSession()->get('firstNeeds')) {
            $form = $this->createForm(TurnoverFormType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var Turnover $turnover */
                $turnover = $form->getData();
                $session = $request->getSession();
                $session->set('turnover', $turnover);

                // $this->addFlash();
                return $this->redirectToRoute('app_incomes');
            }
            return $this->render('turnover.html.twig', [
                'turnoverForm' => $form->createView(),
            ]);
        }

        return $this->redirectToRoute('app_new_simulation');
    }

    /**
     * @Route("/incomes", name="app_incomes")
     */
    public function incomes(EntityManagerInterface $em, Request $request)
    {
        if ($request->getSession()->get('turnover')) {
            $form = $this->createForm(IncomesFormType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var Incomes $incomes */
                $incomes = $form->getData();
                $session = $request->getSession();
                $session->set('incomes', $incomes);

                // $this->addFlash();
                return $this->redirectToRoute('app_costs');
            }
            return $this->render('incomes.html.twig', [
                'incomesForm' => $form->createView(),
            ]);
        }
        return $this->redirectToRoute('app_new_simulation');
    }

    /**
     * @Route("/costs", name="app_costs")
     */
    public function costs(EntityManagerInterface $em, Request $request)
    {
        if ($request->getSession()->get('incomes')) {
            $form = $this->createForm(CostsFormType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var Costs $costs */
                $costs = $form->getData();
                $session = $request->getSession();
                $session->set('costs', $costs);

                // $this->addFlash();
                return $this->redirectToRoute('app_checking');
            }
            return $this->render('costs.html.twig', [
                'costsForm' => $form->createView(),
            ]);
        }
        return $this->redirectToRoute('app_new_simulation');
    }

    /**
     * @Route("/checking", name="app_checking")
     */
    public function checking(Request $request)
    {
        if($request->getSession()->get('costs')) {
            return $this->render('checking.html.twig');
        }
        return $this->redirectToRoute('app_new_simulation_bis');
    }

    /**
     * @Route("/flush", name="app_flush")
     */
    public function flush(EntityManagerInterface $em, Request $request)
    {
        if($request->getSession()->get('charges')) {

            $simulation = $request->getSession()->get('simulation');
            $firstNeeds = $request->getSession()->get('firstNeeds');
            $turnover = $request->getSession()->get('turnover');
            $incomes = $request->getSession()->get('incomes');
            $costs = $request->getSession()->get('costs');

            $em->persist($simulation);
            $em->persist($firstNeeds);
            $em->persist($turnover);
            $em->persist($incomes);
            $em->persist($costs);

            $em->flush();

            $request->getSession()->remove('simulation');
            $request->getSession()->remove('firstNeeds');
            $request->getSession()->remove('turnover');
            $request->getSession()->remove('incomes');
            $request->getSession()->remove('charges');

            return $this->redirectToRoute('app_simulation_view');
        }

        return $this->redirectToRoute('app_new_simulation');
    }

    /**
     * @Route("/simulation_view", name="app_simulation_view")
     */
    public function simulationView()
    {
        
        return $this->redirectToRoute('app_homepage');
    }
}