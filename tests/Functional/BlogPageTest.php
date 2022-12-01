<?php

namespace App\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogPageTest extends WebTestCase
{

    public function testBlogPageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', 'https://localhost/souvenirs');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

  

}
