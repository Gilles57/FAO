<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\Partenaire;
use App\Entity\Point;
use App\Entity\Projet;
use App\Entity\Rubrique;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $rubriques = [];
        // Création des rubriques
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

        // Création des users
        $contact = new User();
        $contact->setEmail('g.salmon@free.fr');
        $contact->setForename('Gilles');
        $contact->setName('SALMON');
        $contact->setPassword('$2y$13$bpRp7C8b8eq3GnWL6VfM2.2DktphM5qP3v9Xg3PFuWCWsHaY3pph6');
        $contact->setRoles(['ROLE_ADMIN']);
        $manager->persist($contact);
        $moi = $contact;

        $contact2 = new User();
        $contact2->setEmail('barbapapan25@gmail.com');
        $contact2->setForename('Étienne');
        $contact2->setName('SALMON');
        $contact2->setPassword('$2y$13$34NeZiP42kSYOqCpMPpSFeyL65nyhQqU.k20ZQ.5M.JiawuZoTP1e');
        $contact2->setRoles(['ROLE_ADMIN']);
        $manager->persist($contact2);

        // Création des points
        $points = [
            ['Besançon', 47.261, 6.045, 1, '2022-07-02 00:00', null],
            ['Nantes', 47.169, -1.721, 0, null, null],
            ['Nîmes', 43.838, 4.358, 0, '2022-06-17 00:00', '2022-06-19 00:00'],
            ['Paris', 48.857, 2.295, 0, '2022-08-01 00:00', '2022-08-08 00:00'],
        ];

        for ($i = 0; $i < count($points); ++$i) {
            $point = new Point();

            $point->setNom($points[$i][0]);
            $point->setLat($points[$i][1]);
            $point->setLon($points[$i][2]);
            $point->setPreferred($points[$i][3]);
            if (null != $points[$i][4]) {
                $point->setStartAt(new \DateTimeImmutable($points[$i][4]));
            }
            if (null != $points[$i][5]) {
                $point->setEndAt(new \DateTimeImmutable($points[$i][4]));
            }

            $manager->persist($point);
        }

        // Création des commentaires
        $commentaire = new Commentaire();
        $commentaire->setMessage("Merci Étienne pour ce moment de partage, d'échange sur le voyage et la musique et ça ".
            'tombe bien car le son pur de ton instrument nous emmène ailleurs, là où tout est possible, dans un '.
            'monde meilleur ! ');
        $commentaire->setPrenom('Virginie');
        $commentaire->setAge(47);
        $commentaire->setRubrique($rubriques[1]);
        $commentaire->setCreatedAt($faker->dateTimeThisDecade());
        $commentaire->setValidate(true);
        $manager->persist($commentaire);

        for ($i = 0; $i < 10; ++$i) {
            $commentaire = new Commentaire();
            $commentaire->setMessage($faker->text(300));
            $commentaire->setPrenom($faker->firstName());
            $commentaire->setAge($faker->numberBetween(10, 100));
            $commentaire->setRubrique($rubriques[$faker->numberBetween(0, 2)]);
            $commentaire->setCreatedAt($faker->dateTimeThisDecade());
            $commentaire->setValidate(true);
            $manager->persist($commentaire);
        }

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

        // Création des articles
        $article = new Article();
        $article->setReference('Est Républicain');
        $article->setPublishedAt(new \DateTimeImmutable('2018-12-22'));
        $article->setMedia('images/presse/ER-2018-12-22.jpg');
        $manager->persist($article);

        $article = new Article();
        $article->setReference('Est Républicain');
        $article->setPublishedAt(new \DateTimeImmutable('2019-01-14'));
        $article->setMedia('images/presse/ER-2019-01-14.jpg');
        $manager->persist($article);

        $article = new Article();
        $article->setReference('Est Républicain');
        $article->setPublishedAt(new \DateTimeImmutable('2019-03-16'));
        $article->setMedia('images/presse/ER-2019-03-16.jpg');
        $manager->persist($article);

        $article = new Article();
        $article->setReference('Est Républicain');
        $article->setPublishedAt(new \DateTimeImmutable('2019-04-26'));
        $article->setMedia('images/presse/ER-2019-04-26.jpg');
        $manager->persist($article);

        // Création des partenaires
        $partenaire = new Partenaire();
        $partenaire->setEntreprise('GilDev');
        $partenaire->setNom('Gilles SALMON');
        $partenaire->setAdresse('');
        $partenaire->setCodepostal('57050');
        $partenaire->setVille('Metz');
        $partenaire->setDescription('Développeur indépendant');
        $partenaire->setTel('');
        $partenaire->setLogo('');
        $manager->persist($partenaire);

        $partenaire = new Partenaire();
        $partenaire->setEntreprise('EDEROD');
        $partenaire->setNom('Florent Recouvreux');
        $partenaire->setAdresse('1D Chemin de Halage de Casamene');
        $partenaire->setCodepostal('25000');
        $partenaire->setVille('Besançon');
        $partenaire->setDescription('Ederod est un fabricant français de Handpan Endro®, un instrument de musique à percussion mélodique en acier. Le Handpan Endro® est un instrument aux qualités sonores exceptionnelles. Il est fabriqué de manière totalement artisanale.');
        $partenaire->setTel('06 65 31 23 52');
        $partenaire->setLogo('images/partenaires/ecolojo.jpg');
        $manager->persist($partenaire);

        $partenaire = new Partenaire();
        $partenaire->setEntreprise('ECOLOJO');
        $partenaire->setNom('Loïc Pegliasco et Jordan Dulché');
        $partenaire->setAdresse('Route du Moulin');
        $partenaire->setCodepostal('88530');
        $partenaire->setVille('La Forge');
        $partenaire->setDescription("Ecolojo, c'est créer des aménagements écoresponsables de vans uniques afin de conjuguer liberté, voyage et bois ! Entièrement conçu sur-mesure, chaque fourgon aménagé sortant de notre atelier est adapté à vos envies et votre mode de vie. Nos aménagements vosgiens sont pensés pour être écoresponsables : bois issu de forêts éco-gérées, isolation écologique (liège, laine de chanvre…), peinture naturelle, etc. sont utilisés pour vous concevoir un habitat le plus sain possible !");
        $partenaire->setTel('07 83 60 02 26');
        $partenaire->setLogo('images/partenaires/edero.jpeg');
        $manager->persist($partenaire);

        $manager->flush();
    }
}
