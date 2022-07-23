<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();

            $this->addFlash(
                'success',
                'Bonjour '.$datas['prenom'].', votre message a été envoyé.<br>Il sera traité le plus rapidement possible.'
            );
            // mail de validation ;
            $message = (new TemplatedEmail())
                ->from('contact@faotravel.fr')
//                ->bcc('barbapapan@gmail.com')
                ->to('g.salmon@free.fr')
                ->subject('FAO Travel : nouveau commentaire à valider')
                ->htmlTemplate('emails/validation.html.twig')
                ->context([
                    'prenom' => $datas['prenom'],
                ]);

            $mailer->send($message);

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('contact/contact.html.twig', compact('form'));
    }
}
