<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EventType;
use App\Repository\EvenementRepository;
use App\Service\GetOsmDataService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[Route('/carte', name: 'app_carte')]
    public function index(EvenementRepository $eventRepo): Response
    {
        $evenements = $eventRepo->findOneById(10);
        $evenements = $eventRepo->findAllInFuture(new \DateTimeImmutable('now'));
        $evenements = $eventRepo->findAll();

        $index = 0;

        foreach ($evenements as $e) {
            $villes[$index]['nom'] = $e->getVille()->getNom();
            $villes[$index]['latitude'] = $e->getVille()->getLatitude();
            $villes[$index]['longitude'] = $e->getVille()->getLongitude();
            if (null != $e->getBeginAt()) {
                $villes[$index]['start'] = $e->getBeginAt()->format('d-m-Y');
            } else {
                $villes[$index]['start'] = '... ?';
            }
            if (null != $e->getEndAt()) {
                $villes[$index]['end'] = $e->getEndAt()->format('d-m-Y');
            } else {
                $villes[$index]['end'] = '... ?';
            }
            $villes[$index]['preferred'] = $e->getPreferred();
            ++$index;
        }
        $villes = json_encode($villes);

        return $this->render('carte/carte.html.twig', compact('villes'));
    }

    #[Route('/new', name: 'app_new_event')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $event = new Evenement();
        $event->setPreferred(0);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('poi_index');
        }

        return $this->render('admin/new.html.twig', [
            'poi' => $event,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/osm', name: 'app_osm')]
    public function getCoordinates(GetOsmDataService $dataService)
    {
        $datas = $dataService->getOsmData('rioz');

        return $datas;
        dd([$datas[0]['display_name'], $datas[0]['lat'], $datas[0]['lon']]);
    }
}
