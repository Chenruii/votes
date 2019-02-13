<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Entity\User;
use App\Form\ConferenceType;
use App\Repository\ConferenceRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/*
 *  @Security("has_role('ROLE_ADMIN')")
 *  Admin can see all  and create
 */

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * list all user and conference
     */
    public function user()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $conferences = $this->getDoctrine()->getRepository(Conference::class)->findAll();
        return $this->render('admin/user.html.twig', [
            'users'=>$users,
            'conferences'=>$conferences,
        ]);
    }
//    /**
//     * @Route("/admin/user/profile-{byId}", name="update_profile")
//     * @ParamConverter("user", options={"mapping"={"byId"="id"}})
//     */
//    public function updateUser(Request $request, User $user, EntityManagerInterface $entityManager){
//        $form = $this->createForm(ProfilUserType::class, $user);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager->persist($user);
//            $entityManager->flush();
//            $this->addFlash('success', 'User updated !');
//            return $this->redirectToRoute('admin_users');
//        }
//        return $this->render('security/profile.html.twig', [
//            'form' => $form->createView()
//        ]);
//    }
//    /**
//     * @Route("admin/user/remove/{id}", name="remove_user")
//     * @ParamConverter("user", options={"mapping"={"id"="id"}})
//     */
//    public function removeUser(User $user, EntityManagerInterface $entityManager)
//    {
//        $conferences = $user->getConference()s();
//        foreach ($conferences as $conference){
//            $conference->setUser(null);
//        }
//        $entityManager->remove($user);
//        $entityManager ->flush();
//        $this->addFlash('success', 'User removed!');
//        return $this->redirectToRoute('home');
//    }
//
//
//    /**
//     * @Route("/admin/conferences", name="admin_conferences")
//     */
//    public function conferences()
//    {
//        $conferences = $this->getDoctrine()->getRepository(Conference::class)->findAll();
//        return $this->render('admin/conference.html.twig', [
//            'conferences'=>$conferences,
//        ]);
//    }
//
//    /**
//     * @Route("/admin/conference/profile-{byId}", name="conference_profile_update")
//     * @ParamConverter("conference", options={"mapping"={"byId"="id"}})
//     */
//    public function updateConference(Conference $conference, Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger){
//        $form = $this->createForm(ConferenceType::class, $conference);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//
//                $entityManager->persist($conference);
//                $entityManager->flush();
//                $this->addFlash('success', 'Conference updated !');
//                $logger->info('Conference updated ! User email :' . $this->getUser()->getEmail() . ', name :' . $conference->getName() . ', id :' . $conference->getId());
//                $this->redirectToRoute('admin_users');
//            }
//            else{
//                $this->addFlash('error', 'Wrong URL !');
//            }
//        }
//        return $this->render('conference/index.html.twig', [
//            'form' => $form->createView(),
//        ]);
//    }
//}
//    /**
//     * @Route("admin/conference/remove/{id}", name="admin_conference_remove")
//     * @ParamConverter("conference", options={"mapping"={"id"="id"}})
//     */
//    public function removeConference
//    (Conference $conference, EntityManagerInterface $entityManager, LoggerInterface $logger)
//    {
//        $entityManager ->remove($conference);
//        $entityManager ->flush();
//        $logger->info('Conference removed ! User email :'.$this->getUser()->getEmail().', title :'.$conference->getName().', id :'.$conference->getId());
//        $this->addFlash('success', 'Conference removed !');
//        return $this->redirectToRoute( 'home');
//    }
//
//}
//}

}
