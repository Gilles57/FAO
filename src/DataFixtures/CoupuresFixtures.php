<?php

namespace App\DataFixtures;

use App\Entity\Coupure;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CoupuresFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création des articles
        $coupure = new Coupure();
        $coupure->setReference('Est Républicain');
        $coupure->setPublishedAt(new \DateTime('2018-12-22'));
        $coupure->setCoupureName('uploads/coupures/ER-2018-12-22.jpg');
        $manager->persist($coupure);

        $coupure = new Coupure();
        $coupure->setReference('Est Républicain');
        $coupure->setPublishedAt(new \DateTime('2019-01-14'));
        $coupure->setCoupureName('uploads/coupures/ER-2019-01-14.jpg');
        $manager->persist($coupure);

        $coupure = new Coupure();
        $coupure->setReference('Est Républicain');
        $coupure->setPublishedAt(new \DateTime('2019-03-16'));
        $coupure->setCoupureName('uploads/coupures/ER-2019-03-16.jpg');
        $manager->persist($coupure);

        $coupure = new Coupure();
        $coupure->setReference('Est Républicain');
        $coupure->setPublishedAt(new \DateTime('2019-04-26'));
        $coupure->setCoupureName('uploads/coupures/ER-2019-04-26.jpg');
        $manager->persist($coupure);

        $manager->flush();
    }
}
