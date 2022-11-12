<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use App\Entity\Rubrique;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker\Factory;

class EventsFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Création des villes
        $villes = [
            ['Besançon', 47.261, 6.045, 1, '2022-10-02 00:00', null],
            ['Nantes', 47.169, -1.721, 0, null, null],
            ['Nîmes', 43.838, 4.358, 0, '2022-10-17 00:00', '2022-10-19 00:00'],
            ['Paris', 48.857, 2.295, 0, '2022-10-01 00:00', '2022-10-08 00:00'],
        ];

        $cities = [];

        for ($i = 0; $i < count($villes); ++$i) {
            $ville = new Ville();
            $ville->setNom($villes[$i][0]);
            $ville->setLatitude($villes[$i][1]);
            $ville->setLongitude($villes[$i][2]);
            $manager->persist($ville);
            $cities[] = $ville;
        }
        $manager->flush();


        // Création des événements
        for ($i = 0; $i < count($cities); ++$i) {
            $interval = $faker->numberBetween(0,5).' day';
            $event = new Evenement();

            $event->setVille($cities[$i]);
            $event->setTitre($faker->sentence);
            $event->setDescription($faker->paragraphs(asText: true));
            $event->setPreferred(False);
            $event->setBeginAt($faker->dateTimeInInterval($date = '-60 days', $interval = '+5 days', $timezone = null));
            $event->setEndAt(clone $event->getBeginAt());
            $event->setEndAt(date_add($event->getEndAt(), date_interval_create_from_date_string($interval)));
            ;
            $event->setUpdatedAt(new \DateTime('now'));
            $event->setRubrique($this->getReference('rubrique' . rand(0, 2)));
            $event->setImageName($cities[$i]->getNom() . '.jpg');

            $manager->persist($event);

        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RubriquesFixtures::class,
        ];
    }
}
