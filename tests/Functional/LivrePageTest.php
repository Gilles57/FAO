<?php

namespace App\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LivrePageTest extends WebTestCase
{

    public function testLivrePageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', 'https://localhost/livredor/relaxation');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }



}
