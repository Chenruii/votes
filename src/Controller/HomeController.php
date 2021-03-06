<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request,AuthenticationUtils $authenticationUtils)
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',

        ]);
    }

    /**
     * @Route("/", name="user_id")
     */
    public  function users(Request$request,User $user)
    {
        return $this->render('home/index.html.twig', [
            'user' => 'user_id',
        ]);
    }

    /**
     * @Route("/", name="user_id")
     */
    public  function conferences(Request $request,Conference $conference)
    {
        return $this->render('home/index.html.twig', [
            'conference' => 'conference_id',
        ]);
    }


//    /**
//     * @Route("/", name="searchBar")
//     */
//    public function  searchBarAction(){
//        $form = $this ->createFormBuilder(null)
//            ->add('search',TextType::class)
//
//
//            ->getForm();
//
//        return $this->render('home/index.html.twig', [
//            'form' => $form->createView()
//        ]);
//
//    }

    /**
     * @Route("/user/profile-{byId}", name="home_user_profile")
     * @ParamConverter("user", options={"mapping"={"byId"="id"}})
     */
    public function user(Request $request, User $user){
        $conferences = $this->getDoctrine()->getRepository(Conference::class)->findBy(array('user'=>$user));
        return $this->render('user/index.html.twig', array('user'=>$user, 'videos'=>$conferences));
    }

}
