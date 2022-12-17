<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\MailerAssertionsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentairePageTest extends WebTestCase
{
    use MailerAssertionsTrait;

    public function testIfSubmitCommentaireFormIsSuccessfull(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/add/livredor');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('.h2', 'Ajouter un commentaire');

        // Récupérer le formulaire
        $submitButton = $crawler->selectButton('Envoyer');
        $form = $submitButton->form();

        $form["commentaire[prenom]"] = "Jean Dupont";
        $form["commentaire[age]"] = "63";
        $form["commentaire[message]"] = "TestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest";
        $form["commentaire[rubrique]"] = 19;

        // Soumettre le formulaire
        $client->submit($form);

//        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
//
//        // Vérifier l'envoi du mail
//        $this->assertEmailCount(1);

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
