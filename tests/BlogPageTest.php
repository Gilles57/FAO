<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BlogPageTest extends WebTestCase
{

    public function testBlogPageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/souvenirs');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertCount(0,  $crawler->filter('img.img-thumbnail'));
        $this->assertCount(1,  $crawler->filter('.pagination'));

    }

  

}
