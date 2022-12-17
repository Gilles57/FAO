<?php

namespace App\Tests;

use App\Entity\Projet;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ProjetsPageTest extends WebTestCase
{
    public function testProjetsPageWorks(): void
    {
        $client = static::createClient();


//        dd($this->entityManager);
//        $nbProjets = count($this->entityManager
//            ->getRepository(Projet::class)
//            ->findAll())
//        ;

        $crawler =  $client->request('GET', '/projets');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertSelectorTextContains('.card-title', 'Le facteur timbré');


    }

   
}
