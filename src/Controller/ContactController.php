<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact', methods: ['GET','POST'])]
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
            // mail de contact ;
            $message = (new TemplatedEmail())
                ->from(new Address('contact@faotravel.fr', 'Site FAO Travel'))
//                ->to(new Address('barbapapan@gmail.com', 'Étienne SALMON'))
                ->bcc(new Address('g.salmon@free.fr', 'Gilles SALMON'))
                ->subject('FAO Travel : nouveau message depuis le site')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'prenom' => $datas['prenom'],
                    'mail' => $datas['email'],
                    'message' => $datas['message'],
                ])
                ->text('Sending emails is fun again!');


            $mailer->send($message);

            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/contact.html.twig', compact('form'));
    }
}
