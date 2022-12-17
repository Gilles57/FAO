<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CartePageTest extends WebTestCase
{

    public function testCartePageWorks(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/carte');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertSelectorExists('#map');

        $this->assertCount(6, $crawler->filter('img'));
    }
}
