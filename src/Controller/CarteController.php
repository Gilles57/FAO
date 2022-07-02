<?php

namespace App\Controller;

use App\Repository\PointRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[Route('/carte', name: 'app_carte')]
    public function index(PointRepository $pointRepository): Response
    {
        $points = $pointRepository->findAll();
        $villes = [];
        $index = 0;

        foreach ($points as $p) {
            $villes[$index]['nom'] = $p->getNom();
            $villes[$index]['lat'] = $p->getLat();
            $villes[$index]['lon'] = $p->getLon();
            $villes[$index]['preferred'] = $p->getPreferred();
            ++$index;
        }
        $villes = json_encode($villes);

        return $this->render('points/carte.html.twig', compact('villes'));
    }
}
