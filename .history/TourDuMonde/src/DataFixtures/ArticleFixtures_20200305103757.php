<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Faker\Factory as Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();

        // création de plusieurs Article
        for ($i = 0; $i < 50; $i++) {
            // instanciation d'une entité
            $article = new Article();
            $article->setName($faker->sentence(3));
            $article->setDescription($faker->text(200));
            $article->setPrice($faker->randomFloat(2, 0.1, 999.99));
            $article->setImage('default.jpg');
            //$product->setImage( $faker->image('public/img/product', 800, 450, null, false) );

            // récupération des références des catégories
            $randomCategory = random_int(0, 4);
            $category = $this->getReference("category$randomCategory");

            // associer une catégorie au produit
            $product->setCategory($category);

            // doctrine : méthode persist permet de créer un enregistrement (INSERT INTO)
            $manager->persist($product);
        }

        // doctrine : méthode flush permet d'exécuter les requêtes SQL (à exécuter une seule fois)
        $manager->flush();
    }
}
