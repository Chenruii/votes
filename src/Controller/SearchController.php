<?php

namespace App\Controller;

use App\Entity\Conference;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index()
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    public function searchAction()
    {
        $conference = new  Conference();

        $form = $this->createFormBuilder( $conference, array(
            'action' => $this->generateUrl('homepage').'?term=',
            'method' => 'GET',
        ) )
            ->add('titre', null, ['label' => ' Barre de recherche'] )
            ->getForm();


        return $this->render(':conference/index.html.twig', ['form' => $form->createView() ]);
    }


}
