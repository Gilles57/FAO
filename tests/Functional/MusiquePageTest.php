<?php

namespace App\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MusiquePageTest extends WebTestCase
{

    public function testMusiquePageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/musique');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);


//        $this->assertCount(3,  $crawler->filter('img.img-thumbnail'));

        $tiktokLink   = $crawler->filter('#tiktok');
        $blogLink   = $crawler->filter('#youtube');
        $crawler2    = $client->click($blogLink->link());
        $crawler3    = $client->click($tiktokLink->link());

        $this->assertEquals($crawler2->getBaseHref(), "https://www.youtube.com/channel/UCJmuI3OdfHtrI7L-Gf2OeDg");
        $this->assertEquals($crawler3->getBaseHref(), "https://www.tiktok.com/@barbapapan");

    }

}
