<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarnetController extends AbstractController
{
    #[Route('/carnet', name: 'app_carnet')]
    public function index(EvenementRepository $eventRepo): Response
    {
//        $events = $eventRepo->findAllInFuture(new \DateTimeImmutable('now'));
        $events = $eventRepo->findAll();
//        $events2 = $pointRepository->findAllwithBeginDefinied();
//        dd($events);
        return $this->render('carnet/carnet.html.twig', compact('events'));
    }
}
