<?php


namespace App\Controller;


use App\Entity\Simulation;
use App\Entity\User;
use App\Form\UserFormType;
use App\Form\UserRegistrationFormType;
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
     * @Route("/planning", name="app_planning")
     */
    public function planning() {
        return $this->render('planning.html.twig');
    }

    /**
     * @Route("/simulations_list", name="app_simulations_list")
     */
    public function simulations_list(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Simulation::class);
        /**@var Simulation $simulations */
        $simulations = $repository->findBy([], ['id' => 'DESC']);

        if (!$simulations) {
            throw $this->createNotFoundException(sprintf('No simulation '));
        }

        dump($repository);
        return $this->render('simulations_list.html.twig', [
            'simulations' => $simulations
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

            return $this->redirectToRoute('app_dashboard');
        }

        return $this->render('register.html.twig', [
            'userRegistrationForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/login", name="app_login")
     */
    public function login() {
        return $this->render('login.html.twig');
    }
}