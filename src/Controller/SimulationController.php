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
use App\Repository\SimulationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class SimulationController extends AbstractController
{
    /**
     * @Route("/new_simulation/{slug?}", name="app_new_simulation")
     */
    public function newSimulation($slug, EntityManagerInterface $em, Request $request)
    {
        // TODO clear session

        if ($slug) {
            $this->editSimulation($slug, $em, $request);
        } else {
            $this->clearSession($request);
        }

        $simulation = new Simulation();

        $form = $this->createForm(SimulationFormType::class, $simulation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
           // /** @var Simulation $simulation */
            $simulation = $form->getData();
            $session = $request->getSession();
            $session->set('simulation', $simulation);

            //  $this->addFlash();
            return $this->redirectToRoute('app_first_needs', array('slug' => $slug));
        }

        return $this->render('simulation/new_simulation.html.twig', [
            'simulationForm'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/first_needs/{slug?}", name="app_first_needs")
     */
    public function firstNeeds($slug, EntityManagerInterface $em, Request $request, UserInterface $user)
    {
        if ($request->getSession()->has('simulation')) {

            $firstNeeds = new FirstNeeds();

            $form = $this->createForm(FirstNeedsFormType::class, $firstNeeds);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
               // /** @var FirstNeeds $firstNeeds */
                $firstNeeds = $form->getData();
                $session = $request->getSession();
                $session->set('firstNeeds', $firstNeeds);

                // $this->addFlash();
                return $this->redirectToRoute('app_turnover', array('slug' => $slug));
            }
            return $this->render('simulation/first_needs.html.twig', [
                'firstNeedsForm' => $form->createView(),
            ]);
        }
        return $this->redirectToRoute('app_new_simulation'); //TODO Passer slug dans la securité avec session
    }

    /**
     * @Route("/turnover/{slug?}", name="app_turnover")
     */
    public function turnover($slug, EntityManagerInterface $em, Request $request)
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
                return $this->redirectToRoute('app_incomes', array('slug' => $slug));
            }
            return $this->render('simulation/turnover.html.twig', [
                'turnoverForm' => $form->createView(),
            ]);
        }

        return $this->redirectToRoute('app_new_simulation');
    }

    /**
     * @Route("/incomes/{slug?}", name="app_incomes")
     */
    public function incomes($slug, EntityManagerInterface $em, Request $request)
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
                return $this->redirectToRoute('app_costs', array('slug' => $slug));
            }
            return $this->render('simulation/incomes.html.twig', [
                'incomesForm' => $form->createView(),
            ]);
        }
        return $this->redirectToRoute('app_new_simulation');
    }

    /**
     * @Route("/costs/{slug?}", name="app_costs")
     */
    public function costs($slug, EntityManagerInterface $em, Request $request)
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
                return $this->redirectToRoute('app_checking', array('slug' => $slug));
            }
            return $this->render('simulation/costs.html.twig', [
                'costsForm' => $form->createView(),
            ]);
        }
        return $this->redirectToRoute('app_new_simulation');
    }

    /**
     * @Route("/checking/{slug?}", name="app_checking")
     */
    public function checking($slug, Request $request)
    {
        if($request->getSession()->has('costs')) {
            return $this->render('simulation/checking.html.twig', array('slug' => $slug));
        }
        return $this->redirectToRoute('app_new_simulation');
    }

    /**
     * @Route("/flush/{slug?}", name="app_flush")
     */
    public function flush(EntityManagerInterface $em, Request $request)
    {
        if($request->getSession()->has('costs')) {

            $idSimulation = $request->getSession()->get('idSimulation');

            if ($idSimulation == null) {
                $simulation = $request->getSession()->get('simulation');
                $simulation->setUserId($this->getUser());
                $simulation->setCreatedAt(new \DateTime('now'));
                $simulation->setState('1'); // TODO 1 = Valid

                /** @var Simulation $simulation */
                // TODO check if better => /** @var FirstNeeds $firstNeedsSession */
                $firstNeedsSession = $request->getSession()->get('firstNeeds');
                $firstNeedsSession->setSimulation($simulation);

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
                $em->persist($firstNeedsSession);
                $em->persist($turnover);
                $em->persist($incomes);
                $em->persist($costs);

            } else {
                /** @var Simulation $simulationSession */
                $simulationSession = $request->getSession()->get('simulation');
                /** @var Simulation $simulationBDD */
                $simulationBDD = $em->getRepository(Simulation::class)->find($idSimulation);
                $simulationBDD->setName($simulationSession->getName());

                /** @var FirstNeeds $firstNeedsSession */
                $firstNeedsSession = $request->getSession()->get('firstNeeds');
                /** @var FirstNeeds $firstNeedsBDD */
                $firstNeedsBDD = $em->getRepository(FirstNeeds::class)->findOneBy(['simulation' => $idSimulation]);
                $firstNeedsBDD->setStartingCash($firstNeedsSession->getStartingCash());
                $firstNeedsBDD->setDepreciation($firstNeedsSession->getDepreciation());
                $firstNeedsBDD->setStartingInvestment($firstNeedsSession->getStartingInvestment());
                $firstNeedsBDD->setStartingStock($firstNeedsSession->getStartingStock());
                $firstNeedsBDD->setOthersNeeds($firstNeedsSession->getOthersNeeds());


                /** @var Turnover $turnoverSession */
                $turnoverSession = $request->getSession()->get('turnover');
                /** @var Turnover $turnoverBDD */
                $turnoverBDD = $em->getRepository(Turnover::class)->findOneBy(['simulation' => $idSimulation]);
                $turnoverBDD->setMonthWorked($turnoverSession->getMonthWorked());
                $turnoverBDD->setDaysWorked($turnoverSession->getDaysWorked());
                $turnoverBDD->setDailyRevenue($turnoverSession->getDailyRevenue());
                $turnoverBDD->setTurnoverIncrease($turnoverSession->getTurnoverIncrease());


                /** @var Incomes $incomesSession */
                $incomesSession = $request->getSession()->get('incomes');
                /** @var Incomes $incomesBDD */
                $incomesBDD = $em->getRepository(Incomes::class)->findOneBy(['simulation' => $idSimulation]);
                $incomesBDD->setBankLoan($incomesSession->getBankLoan());
                $incomesBDD->setPersonnalContribution($incomesSession->getPersonnalContribution());
                $incomesBDD->setContributionInKind($incomesSession->getContributionInKind());
                $incomesBDD->setStartingGrant($incomesSession->getStartingGrant());
                $incomesBDD->setOthersIncomes($incomesSession->getOthersIncomes());


                /** @var Costs $costsSession */
                $costsSession = $request->getSession()->get('costs');
                /** @var Costs $costsBDD */
                //$costRepository = $em->getRepository(Costs::class);
                $costsBDD = $em->getRepository(Costs::class)->findOneBy(['simulation' => $idSimulation]);
                $costsBDD->setSalaries($costsSession->getSalaries());
                $costsBDD->setSalariesIncrease($costsSession->getSalariesIncrease());
                $costsBDD->setRent($costsSession->getRent());
                $costsBDD->setInsurance($costsSession->getInsurance());
                $costsBDD->setOthersFixedCosts($costsSession->getOthersFixedCosts());
                $costsBDD->setVariableCosts($costsSession->getVariableCosts());
                $costsBDD->setTaxes($costsSession->getTaxes());
                $costsBDD->setCorporationTax($costsSession->getCorporationTax());
            }

            $em->flush();

            // TODO check this
            if ($idSimulation != null) {
                $request->getSession()->remove('idSimulation');
            }
            $request->getSession()->remove('simulation');
            $request->getSession()->remove('firstNeeds');
            $request->getSession()->remove('turnover');
            $request->getSession()->remove('incomes');
            $request->getSession()->remove('costs');

            return $this->redirectToRoute('app_simulations_list');
        }

        return $this->redirectToRoute('app_new_simulation');
    }

    /**
     * @Route("/delete_simulation/{slug?}", name="app_delete_simulation")
     */
    public function deleteSimulation($slug, EntityManagerInterface $em, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Simulation::class);
        $simulationToDelete = $repository->find($slug);

        $em->remove($simulationToDelete);
        $em->flush();

        return $this->redirectToRoute('app_simulations_list');
    }


    public function editSimulation($slug, EntityManagerInterface $em, Request $request) {

        $this->clearSession($request);

        $simulationRepository = $em->getRepository(Simulation::class);
        $firstNeedsRepository = $em->getRepository(FirstNeeds::class);
        $turnoverRepository = $em->getRepository(Turnover::class);
        $incomesRepository = $em->getRepository(Incomes::class);
        $costRepository = $em->getRepository(Costs::class);

        /** @var Simulation $simulation */
        $simulation = $simulationRepository->find($slug);

        /** @var FirstNeeds $firstNeeds */
        $firstNeeds = $firstNeedsRepository->findOneBy(['simulation' => $slug]);

        /** @var Turnover $turnover */
        $turnover = $turnoverRepository->findOneBy(['simulation' => $slug]);

        /** @var Incomes $incomes */
        $incomes = $incomesRepository->findOneBy(['simulation' => $slug]);

        /** @var Costs $costs */
        $costs = $costRepository->findOneBy(['simulation' => $slug]);

        $session = $request->getSession();

        $session->set('idSimulation', $slug);
        $session->set('simulation', $simulation);
        $session->set('firstNeeds', $firstNeeds);
        $session->set('turnover', $turnover);
        $session->set('incomes', $incomes);
        $session->set('costs', $costs);
    }

    public function clearSession($request)
    {
        $request->getSession()->remove('idSimulation');
        $request->getSession()->remove('simulation');
        $request->getSession()->remove('firstNeeds');
        $request->getSession()->remove('turnover');
        $request->getSession()->remove('incomes');
        $request->getSession()->remove('costs');
    }
}