<?php

namespace App\Controller\Backend;

use App\Entity\Point;
use App\Form\PoiType;
use App\Repository\PoiRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PoiController extends AbstractController
{
    #[Route('/points', name: 'app_poi')]
    public function star(PoiRepository $poiRepository,  Request $request): Response
    {
//        $pois = $poiRepository->findAll();
//        $id = $request->get('id');
//        $star = $poiRepository->find($id);
//        dump($id);
        $villes = [];
//
//        foreach ($pois as $p) {
//            if ($p->getPreferred()) {
//                $p->setPreferred(false);
//            }
//            $villes[$p->getId()]['nom'] = $p->getNom();
//            $villes[$p->getId()]['lat'] = $p->getLat();
//            $villes[$p->getId()]['lon'] = $p->getLon();
//            $villes[$p->getId()]['preferred'] = $p->getPreferred();
//        }
//
//        $star->setPreferred(true);
//        $em->flush();

        return new JsonResponse(compact('villes'));
    }

    /**
     * @Route("/carte", name="app_carte")
     */
    public function carte(PoiRepository $poiRepository): Response
    {

        $pois = $poiRepository->findAll();
        $villes = [];

        foreach ($pois as $p) {
            $villes[$p->getId()]['nom'] = $p->getNom();
            $villes[$p->getId()]['lat'] = $p->getLat();
            $villes[$p->getId()]['lon'] = $p->getLon();
            $villes[$p->getId()]['prefered'] = $p->getPreferred();
        }
        $villes = json_encode($villes);

        return $this->render('points/carte.html.twig', compact('villes'));
    }

    /**
     * @Route("/points", name="poi_index", methods="GET")
     */
    public function index(PoiRepository $poiRepository): Response
    {
        return $this->render('points/index.html.twig', ['pois' => $poiRepository->findAllOrdered()]);
    }

    /**
     * @Route("/points/new", name="poi_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $poi = new Point();
        $poi->setPreferred(0);
        $form = $this->createForm(PoiType::class, $poi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($poi);
            $em->flush();

            return $this->redirectToRoute('poi_index');
        }

        return $this->render('points/new.html.twig', [
            'points' => $poi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/points/{id}", name="poi_show", methods="GET")
     */
    public function show(Point $poi): Response
    {
        return $this->render('points/show.html.twig', ['points' => $poi]);
    }

    /**
     * @Route("/points/{id}/edit", name="poi_edit", methods="GET|POST")
     */
    public function edit(Request $request, Point $poi): Response
    {
        $form = $this->createForm(PoiType::class, $poi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('poi_index', ['id' => $poi->getId()]);
        }

        return $this->render('points/edit.html.twig', [
            'points' => $poi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/points/{id}", name="poi_delete", methods="DELETE")
     */
    public function delete(Request $request, Point $poi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poi->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($poi);
            $em->flush();
        }

        return $this->redirectToRoute('poi_index');
    }
}
