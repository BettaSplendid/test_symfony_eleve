<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Test;
use App\Entity\Study;

class TestFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $a = 0;
        while ($a <= 10) {
            # code...
            $Test = new Test();
            $Test->setName($faker->company);
            $Test->setsubject($faker->city);
            $Test->setdate($faker->dateTime);

            $a++;
            
            $manager->persist($Test);
            $manager->flush();
        }

    }
}
