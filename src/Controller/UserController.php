<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     *
     */
    public function index(Request $request,UserRepository $userRepository)
    {
        $user = new User();

        $form = $this->createForm(UserType::class ,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);    // file attente
            $entityManager->flush();            // execute file attente
            // type can be anything, for example : notice, warning, error...
            $this->addFlash('notice', 'Your changes were saved!');
            return $this->redirectToRoute('home');

        }

        $users = $userRepository->findAll() ;

        return $this->render('user/index.html.twig', array(
            'form' => $form->createView(),
            'users' =>$users,


        ));
    }
}
