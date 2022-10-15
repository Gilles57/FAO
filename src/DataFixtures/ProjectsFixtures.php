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
        $projet->setDescription('Lors de mes voyages, je rencontre beaucoup de personnes, et, pour en '.
            'rencontrer encore plus, j’ai décidé de transporter des lettres/colis pour les apporter aux amis ou à la '.
            'famille des gens que je rencontre sur la route.'.
            'Un projet simple, efficace, qui ne coûte rien à personne mais qui fait plaisir à ceux qui envoient, '.
            'autant qu’à ceux qui reçoivent. Parce que ne nous voilons pas la face, recevoir une lettre papier est '.
            'toujours plus agréable qu’un simple mail, surtout si c’est moi le facteur !');
        $projet->setIllustrationName('facteur.png');
        $manager->persist($projet);

        $projet = new Projet();
        $projet->setTitre('Tortue de l’espoir');
        $projet->setDescription('Ce projet à deux objectifs. Le premier est de permettre à des enfants '.
            'thaïlandais en grande précarité dans la région de Thung Song (Province de Nakhon Si Thammarat) '.
            'd’obtenir du matériel scolaire gratuitement grâce à l’argent récolté par la vente de l’objet échangé. '.
            'Sur place, un ami expatrié, professeur de français et d’anglais, fera le lien entre vous et moi, '.
            'acteur du projet et les familles en détresse financière.'.
            'Le deuxième objectif est de permettre de financer d’autres projets liés aux activités de FAO Travel.');
        $projet->setIllustrationName('tortue.jpg');
        $manager->persist($projet);

        $projet = new Projet();
        $projet->setTitre('Portrait d’artistes/artisans');
        $projet->setDescription('Au cours de mes voyages, j’ai eu l’occasion de rencontrer des personnes 
            extraordinaires aux talents incroyables. Ce projet a pour objectif de mettre en valeurs ces personnes
            à travers des vidéos qui seront diffusées sur tous mes réseaux.');
        $projet->setIllustrationName('artistes.png');
        $manager->persist($projet);

        $projet = new Projet();
        $projet->setTitre('J’irai jouer chez vous');
        $projet->setDescription('À l’image de d’Antoine de Maximy dans son émission « J’irai dormir chez vous », '.
            'j’irai faire un concert chez les gens, dans leur salon, leur jardin, leur garage… Une façon encore '.
            'différente de découvrir les gens, leurs cultures, leurs traditions…');
        $projet->setIllustrationName('paysage.jpg');
        $manager->persist($projet);

        $manager->flush();
    }
}
