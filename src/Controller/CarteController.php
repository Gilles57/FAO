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
            $villes[$index]['latitude'] = $p->getLat();
            $villes[$index]['longitude'] = $p->getLon();
            if (null != $p->getBeginAt()) {
                $villes[$index]['start'] = $p->getBeginAt()->format('Y-m-d');
            } else {
                $villes[$index]['start'] = '... ?';
            }
            if (null != $p->getEndAt()) {
                $villes[$index]['end'] = $p->getEndAt()->format('Y-m-d');
            } else {
                $villes[$index]['end'] = '... ?';
            }
            $villes[$index]['preferred'] = $p->getPreferred();
            ++$index;
        }
        $villes = json_encode($villes);

        return $this->render('carte/carte.html.twig', compact('villes'));
    }
}
