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
        $articles = $coupureRepo->findAllByDate();

        return $this->render('presse/presse.html.twig', compact('articles'));
    }


    #[Route('/presse/show/{id}', name: 'app_presse_show')]
    public function show($id, CoupureRepository $articleRepository): Response
    {
        $article = $articleRepository->findOneById($id);

        return $this->render('presse/presse_show.html.twig', compact('article'));
    }
}
