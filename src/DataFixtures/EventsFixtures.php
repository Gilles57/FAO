<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class EventsFixtures extends Fixture
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        // Création des villes
        $villes = [
            ['Besançon', 47.261, 6.045, 1, '2022-10-02 00:00', null],
            ['Nantes', 47.169, -1.721, 0, null, null],
            ['Nîmes', 43.838, 4.358, 0, '2022-10-17 00:00', '2022-10-19 00:00'],
            ['Paris', 48.857, 2.295, 0, '2022-10-01 00:00', '2022-10-08 00:00'],
        ];

        // Création des événements
        for ($i = 0; $i < count($villes); ++$i) {
            $event = new Evenement();

            $event->setVille($villes[$i][0]);
            $event->setPreferred($villes[$i][3]);
            if (null != $villes[$i][4]) {
                $event->setBeginAt(new \DateTime($villes[$i][4]));
            }
            if (null != $villes[$i][5]) {
                $event->setEndAt(new \DateTime($villes[$i][4]));
            }

            $manager->persist($event);
        }

        $manager->flush();
    }
}
