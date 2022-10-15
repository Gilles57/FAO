<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\AsciiSlugger;

class PostsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $slugger = new AsciiSlugger();

        $stock = ['0-640x480.jpg','63-640x480.jpg', '277-640x480.jpg', '322-640x480.jpg', '376-640x480.jpg', '390-640x480.jpg'];
        // Création de _posts
        for ($i = 1; $i <= 10; ++$i) {
            $post = new Post();
            $post->setTitre($faker->sentence);
            $post->setSlug($slugger->slug($post->getTitre()));
            $post->setContenu($faker->text(500));
            $post->setCreatedAt($faker->dateTimeBetween('-1 week', 'now'));
            $post->setPublishedAt($faker->dateTimeBetween('now', '+1 week'));
            $post->setPhotoName($faker->randomElement($stock));
            $manager->persist($post);
        }

        $manager->flush();
    }
}
