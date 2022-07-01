<?php

namespace App\Controller\Backend;

use App\Entity\Carnet;
use App\Form\carnetType;
use App\Repository\CarnetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/carnet")
 */
class CarnetController extends AbstractController
{
    /**
     * @Route("/", name="carnet_index", methods={"GET"})
     */
    public function index(CarnetRepository $carnetRepository): Response
    {
        return $this->render('carnet/index.html.twig', [
            'carnets' => $carnetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="carnet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carnet = new Carnet();
        $form = $this->createForm(CarnetType::class, $carnet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $carnet->setMois($carnet->getDate()->format('m'));
            $carnet->setAnnee($carnet->getDate()->format('Y'));
            $entityManager->persist($carnet);
            $entityManager->flush();

            return $this->redirectToRoute('carnet_index');
        }

        return $this->render('carnet/new.html.twig', [
            'carnet' => $carnet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carnet_show", methods={"GET"})
     */
    public function show(Carnet $carnet): Response
    {
        return $this->render('carnet/show.html.twig', [
            'carnet' => $carnet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carnet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Carnet $carnet): Response
    {
        $form = $this->createForm(carnetType::class, $carnet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carnet->setMois(date('n',$carnet->getDate()));
            $carnet->setAnnee(date('Y',$carnet->getDate()));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carnet_index', [
                'id' => $carnet->getId(),
            ]);
        }

        return $this->render('carnet/edit.html.twig', [
            'carnet' => $carnet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carnet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Carnet $carnet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carnet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carnet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carnet_index');
    }
}
