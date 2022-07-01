<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[Route('/trajet', name: 'app_trajet')]
    public function index(): Response
    {
        return $this->render('points/carte.html.twig', [
            'controller_name' => 'CarteController',
        ]);
    }
}
