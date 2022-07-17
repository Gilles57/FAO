<?php

namespace App\DataFixtures;

use App\Entity\Rubrique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Categories extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //      Création de catégories

        $cat1 = new Rubrique();
        $cat1->setNom('Relaxation');
        $manager->persist($cat1);
        $this->addReference('cat1', $cat1);

        $cat2 = new Rubrique();
        $cat2->setNom('Musique et concerts');
        $manager->persist($cat2);
        $this->addReference('cat2', $cat2);

        $cat3 = new Rubrique();
        $cat3->setNom('Animations');
        $manager->persist($cat3);
        $this->addReference('cat3', $cat3);

        $manager->flush();
    }
}
