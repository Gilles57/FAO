<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        $jsonData='{
        "commessa":{"text":"C002 | COMMESSA 002","id":"39"},
        "causale":{"text":"","id":""},
        "dispositivo":{"text":"BRACCIO-PUNTO-PUNTO - BRACCIO PUNTO PUNTO (n.d.)", "id":"1"},
        "operatore":{"text":"Principale","id":"1"},
        "trasferta":{"text":"","id":""},
        "ora":{"inizio":"09:00","fine":"18:00","diff":{"minuti":540,"tempo":"09:00"}},
        "pausa":{"text":"1 ora","id":"1:00"},"viaggio":{"tempo":""},
        "note":"",
        "parent":null,
        "inTheRit":false
        }';
$array_data= json_decode($jsonData);
dd($array_data);
//le probleme: ma var_dump renvoie null;
//        ';
//
//$array_data= json_decode($jsonData);
//var_dump($array_data);
//le probleme: ma var_dump renvoie null;

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
