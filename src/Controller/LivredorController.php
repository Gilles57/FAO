<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivredorController extends AbstractController
{
    #[Route('/livredor', name: 'app_livredor')]
    public function index(): Response
    {
        return $this->render('livredor/index.html.twig', [
        ]);
    }
}
