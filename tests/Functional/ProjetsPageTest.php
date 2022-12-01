<?php

namespace App\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjetPageTest extends WebTestCase
{

    public function testProjetPageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', 'https://localhost/projets');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

   
}
