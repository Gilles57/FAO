<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\Rubrique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RubriquesFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        // Création des rubriques

        $rubrique0 = new Rubrique();
        $rubrique0->setNom('Animations');
        $rubrique0->setColor('#9682f4');
        $manager->persist($rubrique0);
        $this->addReference('rubrique0', $rubrique0);

        $rubrique1 = new Rubrique();
        $rubrique1->setNom('Musique et concerts');
        $rubrique1->setColor('#ed7fc7');
        $manager->persist($rubrique1);
        $this->addReference('rubrique1', $rubrique1);

        $rubrique2 = new Rubrique();
        $rubrique2->setNom('Relaxation');
        $rubrique2->setColor('#bbf482');
        $manager->persist($rubrique2);
        $this->addReference('rubrique2', $rubrique2);

        $manager->flush();

    }
}
