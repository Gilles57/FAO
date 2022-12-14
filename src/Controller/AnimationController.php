<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimationController extends AbstractController
{
    #[Route('/animations', name: 'app_animation')]
    public function index(): Response
    {
        return $this->render('animation/animation.html.twig', [
            'controller_name' => 'AnimationController',
        ]);
    }
}
