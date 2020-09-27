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
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;

class SimulationController extends AbstractController
{
    /**
     * @Route("/new_simulation", name="app_new_simulation")
     */
    public function newSimulation(EntityManagerInterface $em, Request $request)
    {
        $simulation = new Simulation();

        $form = $this->createForm(SimulationFormType::class, $simulation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
           // /** @var Simulation $simulation */
            $simulation = $form->getData();
            $session = $request->getSession();
            $session->set('simulation', $simulation);

            //  $this->addFlash();
            return $this->redirectToRoute('app_first_needs');
        }

        return $this->render('simulation/new_simulation.html.twig', [
            'simulationForm'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/first_needs", name="app_first_needs")
     */
    public function firstNeeds(EntityManagerInterface $em, Request $request, UserInterface $user)
    {
        if ($request->getSession()->has('simulation')) {

            /* TODO to delete
            $test=$request->getSession()->has('simulation');
            $user=$user->getId();
            dump($user);
            dump($test);
            */

            $firstNeeds = new FirstNeeds();

            $form = $this->createForm(FirstNeedsFormType::class, $firstNeeds);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
               // /** @var FirstNeeds $firstNeeds */
                $firstNeeds = $form->getData();
                $session = $request->getSession();
                $session->set('firstNeeds', $firstNeeds);

                // $this->addFlash();
                return $this->redirectToRoute('app_turnover');
            }
            return $this->render('simulation/first_needs.html.twig', [
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
        if ($request->getSession()->has('firstNeeds')) {

            $turnover = new Turnover();
            $form = $this->createForm(TurnoverFormType::class, $turnover);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                ///** @var Turnover $turnover */
                $turnover = $form->getData();
                $session = $request->getSession();
                $session->set('turnover', $turnover);

                // $this->addFlash();
                return $this->redirectToRoute('app_incomes');
            }
            return $this->render('simulation/turnover.html.twig', [
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
        if ($request->getSession()->has('turnover')) {

            $incomes = new Incomes();

            $form = $this->createForm(IncomesFormType::class, $incomes);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
               // /** @var Incomes $incomes */
                $incomes = $form->getData();
                $session = $request->getSession();
                $session->set('incomes', $incomes);

                // $this->addFlash();
                return $this->redirectToRoute('app_costs');
            }
            return $this->render('simulation/incomes.html.twig', [
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
        if ($request->getSession()->has('incomes')) {

            $costs = new Costs();

            $form = $this->createForm(CostsFormType::class, $costs);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
               // /** @var Costs $costs */
                $costs = $form->getData();
                $session = $request->getSession();
                $session->set('costs', $costs);

                // $this->addFlash();
                return $this->redirectToRoute('app_checking');
            }
            return $this->render('simulation/costs.html.twig', [
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
        if($request->getSession()->has('costs')) {
            return $this->render('simulation/checking.html.twig');
        }
        return $this->redirectToRoute('app_new_simulation');
    }

    /**
     * @Route("/flush", name="app_flush")
     */
    public function flush(EntityManagerInterface $em, Request $request)
    {
        if($request->getSession()->has('costs')) {

            $simulation = $request->getSession()->get('simulation');
            $simulation->setUserId($this->getUser());
            $simulation->setCreatedAt(new \DateTime('now'));
            $simulation->setState('1');

            /** @var Simulation $simulation */
            $firstNeeds = $request->getSession()->get('firstNeeds');
            $firstNeeds->setSimulation($simulation);

            /** @var Simulation $simulation */
            $turnover = $request->getSession()->get('turnover');
            $turnover->setSimulation($simulation);

            /** @var Simulation $simulation */
            $incomes = $request->getSession()->get('incomes');
            $incomes->setSimulation($simulation);

            /** @var Simulation $simulation */
            $costs = $request->getSession()->get('costs');
            $costs->setSimulation($simulation);

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
            $request->getSession()->remove('costs');

            return $this->redirectToRoute('app_simulation_view');
        }

        return $this->redirectToRoute('app_new_simulation');
    }

}