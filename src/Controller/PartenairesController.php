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
        $partenaires = $partenaireRepository->findAllSorted();

        return $this->render('partenaires/partenaires.html.twig', compact('partenaires'));
    }

    #[Route('/partenaires/{slug}', name: 'app_partenaire_show')]
    public function show($slug, PartenaireRepository $partenaireRepository): Response
    {
        $partenaire = $partenaireRepository->findOneBySlug($slug);

        return $this->render('partenaires/partenaire_show.html.twig', compact('partenaire'));
    }
}
