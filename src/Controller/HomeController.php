<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $age = $this->age();

        return $this->render('home/index.html.twig', compact('age'));
    }

    #[Route('/mentions', name: 'app_mentions_legales')]
    public function mentions(): Response
    {
        return $this->render('_legal/mentions.html.twig');
    }

    private function age()
    {
        $birthDate = new \DateTime('1986-06-21');
        $now = new \DateTime();
        $age = date_diff($now, $birthDate, true);

        return $age->format('%y');
    }
}
