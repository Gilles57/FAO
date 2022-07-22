<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\RubriqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivredorController extends AbstractController
{
    #[Route('/livredor/index/{rubrique}', name: 'app_livre_index')]
    public function index(CommentaireRepository $commentaireRepository, string $rubrique): Response
    {
        $commentaires = $commentaireRepository->findByRubriqueField($rubrique);

        return $this->render('livredor/livredor.html.twig', compact('commentaires'));
    }

    #[Route('/livredor/add', name: 'app_livre_add')]
     public function saisie(Request $request, CommentaireRepository $repo, EntityManagerInterface $manager, RubriqueRepository $rubriqueRepository): Response
     {
         $commentaire = new Commentaire();
         $rubriques = $rubriqueRepository->findAll();

         $form = $this->createForm(CommentaireType::class, $commentaire);

         $form->createView();
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {

             $commentaire = $form->getData();
             $commentaire->setUpdatedAt(new \DateTime());

             $manager->persist($commentaire);
             $manager->flush();

             return $this->redirectToRoute('app_home');
         }

         return $this->renderForm('livredor/livredor_add.html.twig', compact('form', 'rubriques'));
     }

    #[Route('/test', name: 'app_test')]
    public function test(CommentaireRepository $commentaireRepository): Response
    {
        $commentaires = $commentaireRepository->findByRubriqueField('relax');

        return $this->render('test.html.twig', compact('commentaires'));
    }
}
