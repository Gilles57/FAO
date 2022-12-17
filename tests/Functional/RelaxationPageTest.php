<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RelaxationPageTest extends WebTestCase
{

    public function testRelaxationPageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/relaxation');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertCount(11,  $crawler->filter('img'));

    }

  

}
