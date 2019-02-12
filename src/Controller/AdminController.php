<?php

namespace App\Controller;

use App\Repository\ConferenceRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Request $request,UserRepository $userRepository,ConferenceRepository $conferenceRepository)
    {
        return $this->render('admin/index.html.twig', [
            'users' => $userRepository->findAll(),
            'articles' => $conferenceRepository->findAll(),
        ]);
    }
}
