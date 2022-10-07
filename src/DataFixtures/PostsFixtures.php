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

        // Création de posts
        for ($i = 1; $i <= 10; ++$i) {
            $post = new Post();
            $post->setTitre($faker->sentence);
            $post->setSlug($slugger->slug($post->getTitre()));
            $post->setContenu($faker->text(500));
            $post->setCreatedAt($faker->dateTimeBetween('-1 week', 'now'));
            $post->setPublishedAt($faker->dateTimeBetween('now', '+1 week'));
            $post->setImage('https://picsum.photos/640/480?random='.rand(1, 100));
            $manager->persist($post);
        }


        $manager->flush();
    }
}
