<?php

namespace App\DataFixtures;

use App\Entity\Coupure;
use App\Entity\Commentaire;
use App\Entity\Partenaire;
use App\Entity\Evenement;
use App\Entity\Projet;
use App\Entity\Rubrique;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CoupuresFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // Création des articles
        $coupure = new Coupure();
        $coupure->setReference('Est Républicain');
        $coupure->setPublishedAt(new \DateTimeImmutable('2018-12-22'));
        $coupure->setMedia('images/presse/ER-2018-12-22.jpg');
        $manager->persist($coupure);

        $coupure = new Coupure();
        $coupure->setReference('Est Républicain');
        $coupure->setPublishedAt(new \DateTimeImmutable('2019-01-14'));
        $coupure->setMedia('images/presse/ER-2019-01-14.jpg');
        $manager->persist($coupure);

        $coupure = new Coupure();
        $coupure->setReference('Est Républicain');
        $coupure->setPublishedAt(new \DateTimeImmutable('2019-03-16'));
        $coupure->setMedia('images/presse/ER-2019-03-16.jpg');
        $manager->persist($coupure);

        $coupure = new Coupure();
        $coupure->setReference('Est Républicain');
        $coupure->setPublishedAt(new \DateTimeImmutable('2019-04-26'));
        $coupure->setMedia('images/presse/ER-2019-04-26.jpg');
        $manager->persist($coupure);

        $manager->flush();
    }
}
