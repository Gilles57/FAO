<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use App\Service\GetOsmDataService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VilleController extends AbstractController
{
    #[Route('/ville', name: 'app_ville')]
    public function index(Request $request, GetOsmDataService $osmDataService): Response
    {
        $cities = [];
        $ville = new Ville();
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cities = $osmDataService->getOsmData($ville);
        }

        return $this->render('ville/ville.html.twig', [
            'cities' => $cities,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/add_ville/{name}/{lat}/{lon}', name: 'app_add_ville')]
    public function add_ville($name, $lat, $lon, Request $request, EntityManagerInterface $em): Response
    {
//        dd($name, $lat, $lon, $request);
        $ville = new Ville();
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {
        $ville->setNom($name);
        $ville->setLatitude($lat);
        $ville->setLongitude($lon);

        $em->persist($ville);
        $em->flush();
//        }

        return $this->render('home/index.html.twig');
    }
}
