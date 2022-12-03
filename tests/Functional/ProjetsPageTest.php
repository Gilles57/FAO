<?php

namespace App\Tests\Functional;

use App\Entity\Projet;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjetsPageTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

//    protected function setUp(): void
//    {
//        $kernel = self::bootKernel();
//
//        $this->entityManager = $kernel->getContainer()
//            ->get('doctrine')
//            ->getManager();
//    }

    public function testProjetsPageWorks(): void
    {
        $client = static::createClient();


        dd($this->entityManager);
        $nbProjets = count($this->entityManager
            ->getRepository(Projet::class)
            ->findAll())
        ;

        $crawler =  $client->request('GET', '/projets');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'FAO TRAVEL');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertCount($nbProjets,  $crawler->filter('.card'));


    }

   
}
