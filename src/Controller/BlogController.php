<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    public function __construct(private PostRepository $postRepo)
    {
    }

    #[Route('/blog', name: 'app_blog')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $query = $this->postRepo->getAll();
        $limit = $this->getParameter('nb_posts_per_page');
        $page = $request->query->getInt('page', 1);
        if (0 === $page) {
            $page = 1;
        }
        $posts = $paginator->paginate($query, $page, $limit,
            [PaginatorInterface::PAGE_OUT_OF_RANGE => PaginatorInterface::PAGE_OUT_OF_RANGE_FIX]);

        return $this->render('blog/blog.html.twig', compact('posts'));
    }

    #[Route('/blog/show/{id}', name: 'app_blog_show')]
    public function show($id, PostRepository $postRepo): Response
    {
        $post = $postRepo->find( $id);
//        dd($post);
        return $this->render('blog/blog_show.html.twig', compact('post'));
    }
}
