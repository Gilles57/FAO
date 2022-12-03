<?php

namespace App\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{

    public function testHomePageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testImageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
//        $this->assertFileExists('/images/accueil/accueil.jpeg');
//        $this->assert
//        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testMentionsWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);


        $link = $crawler->selectLink('Mentions légales')->extract(['href'])[0];
        $crawler = $client->request(Request::METHOD_GET, $link);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

     public function testPartenairesWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);


        $link = $crawler->selectLink('GilDev')->extract(['href'])[0];
        $crawler = $client->request(Request::METHOD_GET, $link);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

}
