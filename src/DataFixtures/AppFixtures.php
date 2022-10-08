<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
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

        $manager->flush();
    }
}
