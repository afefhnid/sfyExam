<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Faker\Factory as Faker;
use App\DataFixtures\ContinentFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {

            $article = new Article();
            $article->setName($faker->sentence(3));
            $article->setDescription($faker->text(200));
            $article->setImage('default.jpg');

            $randomContinent = random_int(0, 4);
            $continent = $this->getReference("continent$randomContinent");

            $article->setContinent($continent);


            $manager->persist($article);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ContinentFixtures::class
        ];
    }
}
