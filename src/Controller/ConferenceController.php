<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Form\ConferenceType;
use App\Repository\ConferenceRepository;
use Doctrine\ORM\EntityManagerInterface;
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


    /**
     * @Route("/register", name="register_conference")
     */
    public function registerConference(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $conference = new Conference();
        $form = $this->createForm(ConferenceType::class, $conference);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('register');
        }
        return $this->render('admin/createConference.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
