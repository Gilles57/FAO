<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(ArticleRepository $articleRepo): Response
    {
        $articles = $articleRepo->findAll();

        return $this->render('blog/blog.html.twig', compact('articles'));
    }



    #[Route('/blog/show/{id}', name: 'app_blog_show')]
    public function show($id, ArticleRepository $articleRepo): Response
    {
        $article = $articleRepo->find($id);

        return $this->render('blog/blog_show.html.twig', compact('article'));
    }
}
