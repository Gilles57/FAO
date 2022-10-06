<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(PostRepository $postRepo): Response
    {
        $posts = $postRepo->findAll();

        return $this->render('blog/blog.html.twig', compact('posts'));
    }



    #[Route('/blog/show/{id}', name: 'app_blog_show')]
    public function show($id, PostRepository $postRepo): Response
    {
        $post = $postRepo->find($id);

        return $this->render('blog/blog_show.html.twig', compact('post'));
    }
}
