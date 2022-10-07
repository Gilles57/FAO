<?php

namespace App\Controller;

use App\Repository\PartenaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FooterController extends AbstractController
{
    #[Route('/footer', name: 'app_footer')]
    public function allPartners(PartenaireRepository $partenaireRepository): Response
    {
        $partenaires = $partenaireRepository->findAllSorted();

        return $this->render('home/_footer.html.twig',
            compact('partenaires')
        );
    }
}
