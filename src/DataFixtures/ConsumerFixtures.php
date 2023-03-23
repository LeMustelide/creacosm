<?php

namespace App\DataFixtures;

use App\Entity\Consumer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConsumerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");
        for ($i=0;$i<=10;$i++){
            $consumer = new Consumer();
            $consumer
                ->setMail($faker->email())
                ->setDate(new \DateTime());
            $manager->persist($consumer);
        }
        $manager->flush();
    }
}
