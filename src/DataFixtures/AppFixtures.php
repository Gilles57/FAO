<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\Point;
use App\Entity\Projet;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

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

        $commentaire = new Commentaire();
        $commentaire->setMessage("Merci Étienne pour ce moment de partage, d'échange sur le voyage et la musique et ça tombe bien car le son pur de ton instrument nous emmène ailleurs, là où tout est possible, dans un monde meilleur ! ");
        $commentaire->setPrenom('Virginie');
        $commentaire->setAge(47);
        $manager->persist($commentaire);

        for ($i = 0; $i < 10; ++$i) {
            $commentaire = new Commentaire();
            $commentaire->setMessage($faker->text(300));
            $commentaire->setPrenom($faker->firstName());
            $commentaire->setAge($faker->numberBetween(10, 100));
            $manager->persist($commentaire);
        }
        for ($i = 0; $i < 10; ++$i) {
            $projet = new Projet();
            $projet->setTitre($faker->paragraph());
            $projet->setDescription($faker->text(300));
            $projet->setImage($faker->imageUrl());
            $manager->persist($projet);
        }

        $manager->flush();
    }
}
