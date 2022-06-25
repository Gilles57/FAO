<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienetreController extends AbstractController
{
    #[Route('/bienetre', name: 'app_bienetre')]
    public function index(): Response
    {
        return $this->render('bienetre/index.html.twig', [
            'controller_name' => 'BienetreController',
        ]);
    }
}