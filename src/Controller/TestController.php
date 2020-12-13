<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ClickTypeFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => "Salut, je m'appel HAMED!",
        ]);
    }

    /**
     * @Route("/click", name="click")
     */
    public function click() {
        $user = new User();
        $form = $this->createForm(ClickTypeFormType::class,$user);

        if ($form->isSubmitted() && $form->isValide()) {
            dd($form);
        }
        return $this->render('click/home.html.twig', [
            'title' => "Greeting and Welcome !",
            'title2' => "you wanna play a game ?",
            'form' => $form->createView(),
        ]);
    }
}
