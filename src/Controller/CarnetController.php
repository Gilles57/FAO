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
        $now = new \DateTimeImmutable('now');
        $events = $eventRepo->findAllInFuture($now);
        return $this->render('carnet/carnet.html.twig', compact('events'));
    }

   #[Route('/event[{id}', name: 'app_event_show')]
    public function showEvent(EvenementRepository $eventRepo, int $id): Response
    {
        $event = $eventRepo->findOneById($id);

        return $this->render('carnet/event.html.twig', compact('event'));
    }
}
