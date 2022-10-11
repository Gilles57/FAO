<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MediaController extends AbstractController
{
    #[Route('/media/index', name: 'app_media_index')]
    public function index(PhotoRepository $repo): Response
    {
        $medias = $repo->findAll();

        return $this->render('media/blog.html.twig', compact('medias'));
    }

    #[Route('/media/add', name: 'app_media_new')]
    public function new(Request $request, PhotoRepository $repo): Response
    {
        $media = new Photo();
        $media->setMediaName('Test du nom');

        $form = $this->createFormBuilder($media)
            ->add('mediaName', TextType::class)
            ->add('mediaFile', VichImageType::class)
//            ->add('save', SubmitType::class, ['label' => 'Ajouter'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $media = $form->getData();
            $repo->add($media, true);

            return $this->redirectToRoute('app_media_new');
        }

        return $this->renderForm('media/add.html.twig', compact('form'));
    }
}
