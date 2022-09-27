<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\Partenaire;
use App\Entity\Evenement;
use App\Entity\Projet;
use App\Entity\Rubrique;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

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

        $manager->flush();
    }
}
