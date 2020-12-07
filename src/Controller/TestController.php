<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test/article/32", name="test")
     */
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @Route("/click", name="click")
     */
    public function click() {
        return $this->render('test/home.html.twig', [
            'title' => "Bonjour bienvenue dans la page d'accueil !",
            'age' => 15,
        ]);
    }
}
