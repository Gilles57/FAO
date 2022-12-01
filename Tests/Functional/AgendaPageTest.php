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
        $crawler =  $client->request('GET', 'https://localhost/agenda');

        $fmt = new IntlDateFormatter(
            'fr_FR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            'Europe/Paris',
            IntlDateFormatter::GREGORIAN,
            'MMMM YYYY'
        );
        $currentMonth = $fmt->format(new \Datetime('now'));

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

//        $this->assertSelectorTextContains('h2.fc-toolbar-title', 'novembre 2022');

    }

   
}
