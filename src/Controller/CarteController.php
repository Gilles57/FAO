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
        $events = $eventRepo->findAll();

        $index = 0;
        $cities = [];
        foreach ($events as $e) {

            $cities[$index]['nom'] = $e['ville']['nom'];
            $cities[$index]['latitude'] = $e['ville']['latitude'];
            $cities[$index]['longitude'] = $e['ville']['longitude'];
            if (null != $e['beginAt']) {
                $cities[$index]['start'] = $e['beginAt']->format('d-m-Y');
            } else {
                $cities[$index]['start'] = '... ?';
            }
            if (null != $e['endAt']) {
                $cities[$index]['end'] = $e['endAt']->format('d-m-Y');
            } else {
                $cities[$index]['end'] = '... ?';
            }
            $cities[$index]['preferred'] = $e['preferred'];
            ++$index;
        }
        $cities = json_encode($cities);

        return $this->render('carte/carte.html.twig', compact('cities'));
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

            return $this->redirectToRoute('app_home');
        }

        return $this->render('admin/new.html.twig', [
            'event' => $event,
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
