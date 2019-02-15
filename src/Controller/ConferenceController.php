<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Form\ConferenceRegisterType;
use App\Form\ConferenceType;
use App\Repository\ConferenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ConferenceController extends AbstractController
{
    /**
     * @Route("/conference", name="list_conferences")
     *
     */
    public function conference(ConferenceRepository $conferenceRepository)
    {
        return $this->render( 'conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
        ]);
    }


    /**
     * @Route("/conference", name="list_conferences")
     *
     */
    public function conferences(ConferenceRepository $conferenceRepository)
    {
        return $this->render( 'conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),

        ]);
    }



    /**
     * @Route("/conferences/{id}", name="details_conferences")
     */
    public function details(int $id, ConferenceRepository $conferenceRepository)
    {
        $conference = $conferenceRepository->find($id);
        return $this->render( 'conference/detail.html.twig', [
            'conference' => $conference,

        ]);
    }
    /**
     * @Route("/user/remove/{id}", name="remove_conference")
     *  @ParamConverter("conference", options={"mapping"={"id"="id"}})
     */
    public function remove(Conference $conference, EntityManagerInterface $entityManager)
    {

        $entityManager->remove($conference);
        $entityManager ->flush();
        return $this->redirectToRoute('list_conferences');
    }


//    /**
//     * @Route("/register", name="register_conference")
//     */
//    public function registerConference(Request $request)
//    {
//        $conference = new Conference();
//        $form = $this->createForm(ConferenceType::class, $conference);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($conference);
//            $entityManager->flush();
//            return $this->redirectToRoute('register');
//        }
//        return $this->render('admin/createConference.html.twig', [
////            'form' => $form->createView(),
//            'conference' => $conference
//
//        ]);
//    }
//
//
//    /**
//     * @Route("/conferences/edit/{id}", name="edit_conference")
//     * @ParamConverter("conference", options={"mapping"={"id"="id"}})
//     */
//    public function update(Request $request, Conference $conference)
//    {
//        $form = $this->createForm(ConferenceType::class, $conference);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid())
//        {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($conference);
//            $entityManager->flush();
//
//            $this->addFlash('notice', 'Your conference is update!');
//            return $this->redirectToRoute('list_conferences');
//        }
//        return $this->render('admin/editConference.html.twig', array(
//            'form' => $form->createView(),
//            'conference' => $conference,
//        ));
//    }

    public function searchAction()
    {
        $conference = new  Conference();

        $form = $this->createFormBuilder( $conference, array(
            'action' => $this->generateUrl('home').'?term=',
            'method' => 'GET',
        ) )
            ->add('name', null, ['label' => ' Barre de recherche'] )
            ->getForm();


        return $this->render(':home/index.html.twig', ['form' => $form->createView() ]);
    }

    /**
     * @Route("/search-conference", name="search_conference", defaults={"_format"="json"})
     * @Method("GET")
     */
    public function searchConferenceAction(Request $request)
    {
        $q = $request->query->get('term'); // use "term" instead of "q" for jquery-ui
        $results = $this->getDoctrine()->getRepository('AppBundle:Article')->findLike($q);

        return $this->render("home/search.json.twig", ['conferences' => $results]);
    }

}
