<?php

namespace App\Controller;

use App\Repository\PartenaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartenairesController extends AbstractController
{
    #[Route('/partenaires', name: 'app_partenaires')]
    public function index(PartenaireRepository $partenaireRepository): Response
    {
        $partenaires = $partenaireRepository->findAll();

        return $this->render('partenaires/partenaires.html.twig', compact('partenaires'));
    }

    #[Route('/partenaires/show/{id}', name: 'app_partenaire_show')]
    public function show($id, PartenaireRepository $partenaireRepository): Response
    {
        $partenaire = $partenaireRepository->findOneById($id);

        return $this->render('partenaires/partenaire_show.html.twig', compact('partenaire'));
    }
}
