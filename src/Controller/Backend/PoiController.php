<?php

namespace App\Controller\Backend;

use App\Entity\Poi;
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
    #[Route('/poi', name: 'app_poi')]
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

        return $this->render('poi/carte.html.twig', compact('villes'));
    }

    /**
     * @Route("/poi", name="poi_index", methods="GET")
     */
    public function index(PoiRepository $poiRepository): Response
    {
        return $this->render('poi/index.html.twig', ['pois' => $poiRepository->findAllOrdered()]);
    }

    /**
     * @Route("/poi/new", name="poi_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $poi = new Poi();
        $poi->setPreferred(0);
        $form = $this->createForm(PoiType::class, $poi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($poi);
            $em->flush();

            return $this->redirectToRoute('poi_index');
        }

        return $this->render('poi/new.html.twig', [
            'poi' => $poi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/poi/{id}", name="poi_show", methods="GET")
     */
    public function show(Poi $poi): Response
    {
        return $this->render('poi/show.html.twig', ['poi' => $poi]);
    }

    /**
     * @Route("/poi/{id}/edit", name="poi_edit", methods="GET|POST")
     */
    public function edit(Request $request, Poi $poi): Response
    {
        $form = $this->createForm(PoiType::class, $poi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('poi_index', ['id' => $poi->getId()]);
        }

        return $this->render('poi/edit.html.twig', [
            'poi' => $poi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/poi/{id}", name="poi_delete", methods="DELETE")
     */
    public function delete(Request $request, Poi $poi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poi->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($poi);
            $em->flush();
        }

        return $this->redirectToRoute('poi_index');
    }
}
