<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Continent;
use Faker\Factory as Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ContinentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();
        // création de plusieurs catégories
        for ($i = 0; $i < 5; $i++) {
            // instanciation d'une entité
            $continent = new Continent();
            $continent->setName($faker->unique()->word);

            // créer des références : mise en mémoire d'objets réutilisables dans d'autres fixtures
            // category0 = Category
            // category1 = Category
            // category2 = Category
            $this->addReference("continent$i", $continent);

            // doctrine : méthode persist permet de créer un enregistrement (INSERT INTO)
            $manager->persist($continent);
        }

        // doctrine : méthode flush permet d'exécuter les requêtes SQL (à exécuter une seule fois)
        $manager->flush();
    }
}
