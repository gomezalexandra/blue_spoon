<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


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
     * @Route("/register", name="app_register")
     */
    public function register(EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(UserFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_dashboard');
        }
        return $this->render('register.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(EntityManagerInterface $em) {
        $form = $this->createForm(UserFormType::class);

        return $this->render('login.html.twig', [
            'userForm' => $form->createView(),

        ]);
    }
}