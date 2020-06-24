<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\SearchBarType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $form = $this->createForm(SearchBarType::class , new City() ) ;
        return $this->render('landing/index.html.twig', [
            'controller_name' => 'LandingController',
            'formCity' => $form->createView()
        ]);
    }
}
