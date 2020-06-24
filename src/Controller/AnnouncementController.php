<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Form\AnnouncementType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncementController extends AbstractController
{
    /**
     * @Route("/announcement/new", name="new_announcement")
     */
    public function index(Request $request , ObjectManager $manager)
    {
        if( !$this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            $session = $request->getSession() ;
            $this->addFlash('error' , 'You need to Log In first !');
            return $this->redirectToRoute('security_login') ;

        }
        $ann = new Announcement() ;
        $form = $this->createForm(AnnouncementType::class , $ann) ;
        $form->handleRequest($request) ;
        if($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser() ;
            $ann->setUserOwner($user) ;
            $ann->setPostedAt(new \DateTime()) ;
            $manager->persist($ann) ;
            $manager->flush();
            $this->addFlash('success' , 'Your announcement has been successfully added :) ');
            return $this->redirectToRoute('home') ;
        }


        return $this->render('announcement/index.html.twig', [
            'controller_name' => 'AnnouncementController',
            'ann' => $ann ,
            'formAnnouncement' => $form->createView()
        ]);
    }
}
