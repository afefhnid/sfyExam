<?php

namespace App\DataFixtures;

use App\Entity\Continent;
use Faker\Factory as Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ContinentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();
        for ($i = 0; $i < 5; $i++) {

            $continent = new Continent();
            $continent->setName($faker->unique()->word);
            $this->addReference("continent$i", $continent);
            $manager->persist($continent);
        }

        $manager->flush();
    }
}
