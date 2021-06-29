<?php


namespace App\Controller;


use App\Entity\Costs;
use App\Entity\Simulation;
use App\Entity\Turnover;
use App\Entity\User;
use App\Form\SearchFormType;
use App\Form\SimulationFormType;
use App\Form\UserFormType;
use App\Form\UserRegistrationFormType;
use App\Repository\CostsRepository;
use App\Repository\FirstNeedsRepository;
use App\Repository\IncomesRepository;
use App\Repository\SimulationRepository;
use App\Repository\TurnoverRepository;
use App\Service\IncomeStatement;
use ContainerDl8CESw\getSecurity_HttpUtilsService;
use ContainerDl8CESw\getUserInterfaceService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class FrontController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route("/how_it_works", name="app_explanation")
     */
    public function explanation()
    {
        return $this->render('explanation.html.twig');
    }

    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function dashboard() {
        return $this->render('dashboard.html.twig');
    }

    /**
     * @Route("/author", name="app_author")
     */
    public function planning() {
        return $this->render('author.html.twig');
    }

    /**
     * @Route("/simulations_list", name="app_simulations_list")
     */
    public function simulationsList(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(SimulationFormType::class);
        $form->handleRequest($request);

        /*$repository = $em->getRepository(Simulation::class);
        /**@var Simulation $simulations */
        /*$simulations = $repository->findBy([], ['id' => 'DESC']);*/

        $user = $this->getUser();
        $emailUser = $user->getUsername();
        $userRepository = $em->getRepository(User::class);
        $userLogged = $userRepository->findBy(['email' => $emailUser]);
        $userId = $userLogged[0]->getId();

        $repository = $em->getRepository(Simulation::class);
        /**@var Simulation $simulations */
        $simulations = $repository->getMySimulations($userId);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if (!$data) {
                throw $this->createNotFoundException(sprintf('No data '));
            }
            $name = $data->getName();

            /**@var Simulation $simulations */
            $simulations = $repository->findBy(['name' => $name, 'user_id' => $userId],['id' => 'DESC']);
        }

        if (!$simulations) {
//            throw $this->createNotFoundException(sprintf('No simulation '));
            $simulations = [];
        }

        return $this->render('simulations_list.html.twig', [
            'simulations' => $simulations,
            'simulationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/simulations_draft", name="app_simulations_draft")
     */
    public function simulationsDraft(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Simulation::class);
        /**@var Simulation $simulations */
        $simulations = $repository->findBy([], ['id' => 'DESC']);

        if (!$simulations) {
            throw $this->createNotFoundException(sprintf('No simulation '));
        }

        return $this->render('simulations_draft.html.twig', [
            'simulations' => $simulations
        ]);
    }

    /**
     * @Route("/simulation_view/{slug}", name="app_simulation_view")
     */
    public function simulationView($slug, IncomeStatement $incomeStatement, SimulationRepository $simulationRepository, TurnoverRepository $turnoverRepository, CostsRepository $costsRepository, FirstNeedsRepository $firstNeedsRepository, IncomesRepository $incomesRepository) {

        $simulation = $simulationRepository->find($slug);

        $result = $incomeStatement->calculate($slug);

        if (!$simulation || !$result['turnover']) {
            throw $this->createNotFoundException(sprintf('No simulation or turnover')); //TODO
        }

        return $this->render('simulation_view.html.twig', [
            'simulation' => $simulation,
            'result' => $result,
        ]);
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $passwordEncoder) {

        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var User $user */
            $user = $form->getData();

            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $user->getPassword()
            ));

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Enregistrement effectué !');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('register.html.twig', [
            'userRegistrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profile", name="app_profile")
     */
    public function profile() {

        return $this->render('profile.html.twig');
    }

    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact() {

        return $this->render('contact.html.twig');
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login() {
        return $this->render('login.html.twig');
    }
}