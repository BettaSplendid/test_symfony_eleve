<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Boss;

class BossFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $a = 0;
        while ($a <= 10) {
            # code...
            $Boss = new Boss();
            $Boss->setLastname($faker->lastName);
            $Boss->setFirstname($faker->name);
            $Boss->setEmail($faker->email);
            $Boss->setPassword($faker->userName);
            $Boss->setBadgeNumber(rand());

            $Boss->setRoles(["Boss"]);



            $a++;
            $manager->persist($Boss);
        }

        $manager->flush();
    }
}
