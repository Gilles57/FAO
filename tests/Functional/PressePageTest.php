<?php

namespace App\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PressePageTest extends WebTestCase
{

    public function testPressePageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/presse');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertCount(4,  $crawler->filter('.card'));

        $link   = $crawler->filter('a.lien');
        $crawler2    = $client->click($link->link());
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertSelectorTextContains('a.btn', 'Retour aux coupures de presse');
    }


}
