<?php

namespace App\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BienetrePageTest extends WebTestCase
{

    public function testBienetrePageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/bienetre');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertCount(2,  $crawler->filter('.card'));

    }

  

}
