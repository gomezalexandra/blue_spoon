<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function register() {
        return $this->render('register.html.twig');
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login() {
        return $this->render('login.html.twig');
    }
}