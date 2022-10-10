<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\RubriqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
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
    public function saisie(Request $request, CommentaireRepository $repo,
        EntityManagerInterface $manager,
        MailerInterface $mailer,
        RubriqueRepository $rubriqueRepository): Response
    {
        $commentaire = new Commentaire();
        $rubriques = $rubriqueRepository->findAll();

        $form = $this->createForm(CommentaireType::class, $commentaire);

        $form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();

            $commentaire->setPrenom($datas->getPrenom());
            $commentaire->setAge($datas->getAge());
            $commentaire->setMessage($datas->getMessage());
            $commentaire->setRubrique($datas->getRubrique());
            $commentaire->setValidate(false);
//dd($commentaire);
            $repo->add($commentaire, true);

            $postUrl = $this->generateUrl('admin', [
                'crudAction' => 'edit',
                'crudControllerFqcn' => 'App\Controller\Admin\CommentaireCrudController',
                'entityId' => $commentaire->getId(),
            ]);

            $this->addFlash(
                'success',
                'Bonjour '.$commentaire->getPrenom().", votre message a été envoyé.<br>Il sera visible lorsqu'il aura été validé."
            );
            // mail de validation ;
            $message = (new TemplatedEmail())
                ->from(new Address('contact@faotravel.fr', 'Site FAO Travel'))
//                ->bcc(new Address('barbapapan@gmail.com', 'Étienne SALMON'))
                ->to(new Address('g.salmon@free.fr', 'Gilles SALMON'))
                ->subject('FAO Travel : nouveau commentaire à valider')
                ->htmlTemplate('emails/validation.html.twig')
                ->context([
                    'prenom' => $commentaire->getPrenom(),
                    'postUrl' => $postUrl,
                ]);

            $mailer->send($message);

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
