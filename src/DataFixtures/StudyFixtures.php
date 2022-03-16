<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Study;

class StudyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $a = 0;
        while ($a <= 10) {
            # code...
            $Study = new Study();
            $Study->setStart($faker->dateTime);
            $Study->setFinish($faker->dateTime);
            $Study->setName($faker->company);
            $a++;
            
            $manager->persist($Study);
            $manager->flush();
        }

    }
}
