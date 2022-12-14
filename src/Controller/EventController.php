<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use App\Repository\RubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/agenda', name: 'app_agenda')]
    public function index(EvenementRepository $eventRepo, RubriqueRepository $rubriqueRepo): Response
    {
        $rubriques = $rubriqueRepo->findAll();

        $events = $eventRepo->findAllInFuture(new \DateTimeImmutable('-1 day'));
        return $this->render('agenda/agenda.html.twig', compact('events', 'rubriques'));
    }

   #[Route('/event/{slug}/{id}', name: 'app_event_show')]
    public function showEvent(EvenementRepository $eventRepo, int $id): Response
    {
        $event = $eventRepo->findOneById($id);

        return $this->render('agenda/event.html.twig', compact('event'));
    }
}
