<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresseController extends AbstractController
{
    #[Route('/presse', name: 'app_presse')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        return $this->render('presse/presse.html.twig', compact('articles'));
    }

    #[Route('/presse2', name: 'app_presse2')]
    public function indexbis(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        return $this->render('presse/presse2.html.twig', compact('articles'));
    }


    #[Route('/presse/show/{id}', name: 'app_presse_show')]
    public function show($id, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->findOneById($id);

        return $this->render('presse/presse_show.html.twig', compact('article'));
    }
}
