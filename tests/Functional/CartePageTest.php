<?php

namespace App\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartePageTest extends WebTestCase
{

    public function testCartePageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', 'https://localhost/carte');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    

}
