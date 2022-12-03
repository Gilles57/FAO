<?php

namespace App\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AnimationPageTest extends WebTestCase
{

    public function testAnimationPageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/animations');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertCount(6,  $crawler->filter('tr'));

    }


}
