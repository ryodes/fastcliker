<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ClickTypeFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
            'controller_name' => "Salut, je m'appelle Ryodes!",
        ]);
    }

    /**
     * @Route("/click", name="click")
     */
    public function click(Request $request, UserRepository $userRepository, EntityManagerInterface $em) {
        $user = new User();

        $form = $this->createForm(ClickTypeFormType::class,$user);
        $form->handleRequest($request);

        if (count($userRepository->findAll() > 11)) {
            $delete = $userRepository->deleteMoreThan10();
            foreach ($delete as $i) {
                $em->remove($i);
            }
            $em->flush();
        }
        
        $users = $userRepository->findByClicsOrdyByDESC();

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('click');
        }

        return $this->render('click/home.html.twig', [
            'form' => $form->createView(),
            'users' => $users,
        ]);
    }
}
