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

class PartnersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

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
