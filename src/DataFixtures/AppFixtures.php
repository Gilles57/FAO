<?php

namespace App\DataFixtures;

use App\Entity\Point;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $points = [
            ['Teluk Bahang', 5.451459, 100.212194, 1],
            ['Cable car', 6.371694, 99.671673, 0],
            ['Butterfly', 6.369682, 99.714647, 0],
            ['Kuah', 6.320639, 99.848726, 0],
            ['Koh Lipe', 6.487, 99.303, 0],
        ];
        for ($i = 0; $i < count($points); ++$i) {
            $point = new Point();

            $point->setNom($points[$i][0]);
            $point->setLat($points[$i][1]);
            $point->setLon($points[$i][2]);
            $point->setPreferred($points[$i][3]);
            $point->setStartAt(new \DateTimeImmutable());
            $point->setEndAt(new \DateTimeImmutable());

            $manager->persist($point);
        }
        $manager->flush();
    }
}

