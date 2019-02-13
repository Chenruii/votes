<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Repository\ConferenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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




}
