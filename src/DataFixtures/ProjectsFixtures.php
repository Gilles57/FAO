<?php

namespace App\DataFixtures;

use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création des projets
        $projet = new Projet();
        $projet->setTitre('Le facteur timbré');
        $projet->setDescription('Ce projet consiste à récupérer des lettres/colis des personnes rencontrées '.
            'le long de ma route et de les emmener à leurs destinataires. Cela me permet d’étendre mon réseau et de '.
            'faire de nouvelles rencontres. C’est l’une des actions qui me permet de développer mon activité principale'.
            ' et de signer des contrats.
 ');
        $projet->setImage('images/projets/facteur.png');
        $manager->persist($projet);

        $projet = new Projet();
        $projet->setTitre('Tortue de l’espoir');
        $projet->setDescription('L’image peut rester la même ou tu peux prendre le logo du dossier
 ');
        $projet->setImage('images/projets/tortue.jpg');
        $manager->persist($projet);

        $projet = new Projet();
        $projet->setTitre('Portrait d’artistes/artisans');
        $projet->setDescription('Au cours de mes voyages, j’ai eu l’occasion de rencontrer des personnes '.
            'extraordinaires aux talents incroyables. Ce projet a pour objectif de mettre en valeurs ces personnes '.
            'à travers des vidéos qui seront diffusées sur tous mes réseaux.
 ');
        $projet->setImage('images/projets/artistes.png');
        $manager->persist($projet);

        $projet = new Projet();
        $projet->setTitre('J’irai jouer chez vous');
        $projet->setDescription('À l’image de d’Antoine de Maximy dans son émission « J’irai dormir chez '.
            'vous », moi, j’irai faire des concerts chez les gens. Encore une fois, ce projet est un prétexte pour '.
            'rencontrer de nouvelles personnes et de nouveaux endroits.
 ');
        $projet->setImage('images/projets/paysage.jpg');
        $manager->persist($projet);

        $manager->flush();
    }
}
