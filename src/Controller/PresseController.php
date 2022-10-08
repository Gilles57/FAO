<?php

namespace App\Controller;

use App\Repository\CoupureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresseController extends AbstractController
{
    #[Route('/presse', name: 'app_presse')]
    public function index(CoupureRepository $coupureRepo): Response
    {
        $coupures = $coupureRepo->findAllByDate();

        return $this->render('presse/presse.html.twig', compact('coupures'));
    }

    #[Route('/presse/show/{id}', name: 'app_presse_show')]
    public function show($id, CoupureRepository $coupureRepo): Response
    {
        $coupure = $coupureRepo->findOneById($id);

        return $this->render('presse/presse_show.html.twig', compact('coupure'));
    }
}
