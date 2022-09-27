<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class PointsFixtures extends Fixture
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        // Création des points
        $points = [
            ['Besançon', 47.261, 6.045, 1, '2022-07-02 00:00', null],
            ['Nantes', 47.169, -1.721, 0, null, null],
            ['Nîmes', 43.838, 4.358, 0, '2022-06-17 00:00', '2022-06-19 00:00'],
            ['Paris', 48.857, 2.295, 0, '2022-08-01 00:00', '2022-08-08 00:00'],
        ];

        for ($i = 0; $i < count($points); ++$i) {
            $point = new Evenement();

            $point->setNom($points[$i][0]);
            $point->setLat($points[$i][1]);
            $point->setLon($points[$i][2]);
            $point->setPreferred($points[$i][3]);
            if (null != $points[$i][4]) {
                $point->setBeginAt(new \DateTimeImmutable($points[$i][4]));
            }
            if (null != $points[$i][5]) {
                $point->setEndAt(new \DateTimeImmutable($points[$i][4]));
            }

            $manager->persist($point);
        }

        $manager->flush();
    }
}
