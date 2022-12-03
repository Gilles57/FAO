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
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class LivredorController extends AbstractController
{
    #[Route('/livredor/{rubrique}', name: 'app_livre_index')]
    public function index(CommentaireRepository $commentaireRepository, string $rubrique): Response
    {
        $commentaires = $commentaireRepository->findByRubriqueField($rubrique);

        return $this->render('livredor/livredor.html.twig', compact('commentaires'));
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/add/livredor', name: 'app_livre_add')]
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

            $repo->add($commentaire, true);

            $postUrl = $this->generateUrl('admin', [
                'crudAction' => 'edit',
                'crudControllerFqcn' => 'App\Controller\Admin\CommentaireCrudController',
                'entityId' => $commentaire->getId(),
            ]);

            $this->addFlash(
                'success',
                'Bonjour '.$commentaire->getPrenom().", ton message a été envoyé.<br>Il sera visible lorsqu'il aura été validé."
            );
            // mail de validation ;
            $message = (new TemplatedEmail())
                ->from(new Address('contact@faotravel.fr', 'Site FAO Travel'))
                ->to(new Address('barbapapan@gmail.com', 'Étienne SALMON'))
                ->bcc(new Address('gilles.salmon.57@gmail.com', 'Gilles SALMON'))
                ->subject('FAO Travel : nouveau commentaire à valider')
                ->htmlTemplate('emails/commentaire.html.twig')
                ->context([
                    'message' => $commentaire->getMessage(),
                    'prenom' => $commentaire->getPrenom(),
                    'age' => $commentaire->getAge(),
                    'rubrique' => $commentaire->getRubrique()->getNom(),
                    'postUrl' => $postUrl,
                ])
            ->text('Sending commentaires is fun again!');

            $mailer->send($message);

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('livredor/livredor_add.html.twig', compact('form', 'rubriques'));
    }
}
