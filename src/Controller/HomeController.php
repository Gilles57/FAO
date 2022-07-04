<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/test', name: 'app_test')]
    public function test(UserRepository $repo): Response
    {
        $u = new User();
        $u->setForename('Gilles');
        $u->setName('SALMON');
        $u->setEmail('top.note@free.fr');
        $u->setPassword('$2y$13$bpRp7C8b8eq3GnWL6VfM2.2DktphM5qP3v9Xg3PFuWCWsHaY3pph6');
        $u->setRoles(['ROLE_ADMIN']);

        $repo->add($u);

        return $this->render('test.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
