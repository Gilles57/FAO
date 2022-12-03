<?php

namespace App\Tests\Functional;

use IntlDateFormatter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AgendaPageTest extends WebTestCase
{

    public function testAgendaPageWorks(): void
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/agenda');

//        $fmt = new IntlDateFormatter(
//            'fr_FR',
//            IntlDateFormatter::FULL,
//            IntlDateFormatter::FULL,
//            'Europe/Paris',
//            IntlDateFormatter::GREGORIAN,
//            'MMMM YYYY'
//        );
//        $currentMonth = $fmt->format(new \Datetime('now'));
//        $this->assertSelectorTextContains('#fc-dom-1', $currentMonth);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertCount(3,  $crawler->filter('.badge'));
        $this->assertSelectorTextContains(".toto","Il n'y a aucun événement de programmé prochainement");
    }

   
}
