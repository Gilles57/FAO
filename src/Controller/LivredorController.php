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
//        if ($commentaires == null){
//
//        }
//        dd($commentaires);

        return $this->render('livredor/livredor.html.twig', compact('commentaires'));
    }
}
