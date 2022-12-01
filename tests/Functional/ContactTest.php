<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\MailerAssertionsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ContactTest extends WebTestCase
{
    use MailerAssertionsTrait;

    public function testIfSubmitContactFormIsSuccessfull(): void
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/contact');

//        $client->request('GET', '/contact');
        $this->assertResponseIsSuccessful();

        // Récupérer le formulaire
        $submitButton = $crawler->selectButton('Envoyer');
        $form = $submitButton->form();

        $form["contact[prenom]"] = "Jean Dupont";
        $form["contact[email]"] = "g.salmon@free.fr";
        $form["contact[message]"] = "Test";

        // Soumettre le formulaire
//        dd($client->submit($form));

//        $this->assertEmailCount(1);

        $email = $this->getMailerMessage();

//        $this->assertEmailHtmlBodyContains($email, 'Welcome');
//        $this->assertEmailTextBodyContains($email, 'Welcome');
//
//        $client = static::createClient();
//        $crawler = $client->request('GET', '/contact');
//
//        $this->assertResponseIsSuccessful();
//
//        $this->assertSelectorTextContains('.h2', 'Envoyer');
//
//        // Récupérer le formulaire
//        $submitButton = $crawler->selectButton('Envoyer');
//        $form = $submitButton->form();
//
//        $form["contact[prenom]"] = "Jean Dupont";
//        $form["contact[email]"] = "g.salmon@free.fr";
//        $form["contact[message]"] = "Test";
//
//        // Soumettre le formulaire
//        $client->submit($form);

        // Vérifier le statut HTTP
//        $this->assertResponseIsSuccessful();

//        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        // Vérifier l'envoie du mail
//        $this->assertEmailCount(1, $transport = 'doctrine://default');

        $client->followRedirect();

        // Vérifier la présence du message de succès
        $this->assertSelectorTextContains(
            'alert.alert-success.text-center',
            'Il sera traité le plus rapidement possible.'
        );
    }
}
