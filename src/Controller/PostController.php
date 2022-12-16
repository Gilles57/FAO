<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

#[Route('/post')]
class PostController extends AbstractController
{
    #[Route('/index', name: 'app_post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/sitemap.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        $post->setSlug('todo : set slug');

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les photos transmises par le formulaire
            $photos = $form->get('photos')->getData();
            // On boucle sur les photos
            foreach ($photos as $photo){
                // On crée un nom de fichier unique
                $fichier = md5(uniqid()).'.'. $photo->guessExtension();
                // On enregistre le fichier sur le DD
                $photo->move(
                    $this->getParameter('photos_directory'),
                    $fichier
                );
                // On stocke le nom du fichier dans la BDD
                $img = new Photo();
                $img->setPhotoName($fichier);
                $post->addPhoto($img);
            }

            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_show', methods: ['GET'])]
    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les photos transmises par la formulaire
            $photos = $form->get('photos')->getData();
            // On boucle sur les photos
            foreach ($photos as $photo){
                // On crée un nom de fichier unique
                $fichier = md5(uniqid()).'.'. $photo->guessExtension();
                // On enregistre le fichier sur le DD
                $photo->move(
                    $this->getParameter('photos_directory'),
                    $fichier
                );
                // On stocke le nom du fichier dans la BDD
                $img = new Photo();
                $img->setPhotoName($fichier);
                $post->addPhoto($img);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_delete', methods: ['POST'])]
    public function delete(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/supprime/{id}', name: 'app_photo_supprime', methods: ['DELETE'])]
    public function deletePhoto(Photo $photo, Request $request, EntityManagerInterface $em)
    {
        $data = json_decode($request->getContent(), true);
        // Vérification du token
        if ($this->isCsrfTokenValid('delete'.$photo->getId(), $data['_token'])){
            $nom = $photo->getPhotoName();
            // On supprime le fichier
            unlink($this->getParameter('photos_directory')."/".$nom);
            // On supprime dans la BDD
            $em->remove($photo);
            $em->flush();

            // On répond
            return new JsonResponse(['success'=> 1]);
        }else{
            return new JsonResponse(['error'=> 'Token invalide'], 400);
        }
    }
}
