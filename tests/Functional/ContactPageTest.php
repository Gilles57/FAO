<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\MailerAssertionsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ContactPageTest extends WebTestCase
{
    use MailerAssertionsTrait;

    public function testIfSubmitContactFormIsSuccessfull(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('.h2', 'Envoyer');

        // Récupérer le formulaire
        $submitButton = $crawler->selectButton('Envoyer');
        $form = $submitButton->form();

        $form["contact[prenom]"] = "Jean Dupont";
        $form["contact[email]"] = "g.salmon@free.fr";
        $form["contact[message]"] = "TestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest";

        // Soumettre le formulaire
        $client->submit($form);

//        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
//
//        // Vérifier l'envoi du mail
//        $this->assertEmailCount(1);
//
//        $client->followRedirect();
//
//        // Vérifier l'arrivée sur la page d'accueil'
//        $this->assertSelectorTextContains(
//            'h1.h4',
//            'Salut'
//        );
////        // Vérifier la présence du message de succès personnalisé
//        $this->assertSelectorTextContains(
//            '.alert',
//            'Bonjour Jean Dupont'
//        );
    }
}
