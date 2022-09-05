<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\Rubrique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Création des rubriques
        $rubriques = [];

        $rubrique1 = new Rubrique();
        $rubrique1->setNom('Animations');
        $manager->persist($rubrique1);
        $rubriques[0] = $rubrique1;

        $rubrique2 = new Rubrique();
        $rubrique2->setNom('Musique et concerts');
        $manager->persist($rubrique2);
        $rubriques[1] = $rubrique2;

        $rubrique3 = new Rubrique();
        $rubrique3->setNom('Relaxation');
        $manager->persist($rubrique3);
        $rubriques[2] = $rubrique3;

        // Création des commentaires
        $commentaire = new Commentaire();
        $commentaire->setMessage("Merci Étienne pour ce moment de partage, d'échange sur le voyage et la musique et ça ".
            'tombe bien car le son pur de ton instrument nous emmène ailleurs, là où tout est possible, dans un '.
            'monde meilleur ! ');
        $commentaire->setPrenom('Virginie');
        $commentaire->setAge(47);
        $commentaire->setRubrique($rubriques[1]);
        $commentaire->setValidate(true);
        $manager->persist($commentaire);



        $manager->flush();
    }
}
