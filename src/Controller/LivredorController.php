<?php

namespace App\Controller;

use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivredorController extends AbstractController
{
    #[Route('/livredor/{rubrique}', name: 'app_livre')]
    public function index(CommentaireRepository $commentaireRepository, string $rubrique): Response
    {
        $commentaires = $commentaireRepository->findByRubriqueField($rubrique);

        return $this->render('livredor/livredor.html.twig', compact('commentaires'));
    }

    #[Route('/test', name: 'app_test')]
    public function test(CommentaireRepository $commentaireRepository): Response
    {
        $commentaires = $commentaireRepository->findByRubriqueField('relax');

        return $this->render('test.html.twig', compact('commentaires'));
    }
}
