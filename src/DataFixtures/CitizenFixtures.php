<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Repository\CitizenRepository;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Citizen;
use Doctrine\Persistence\ManagerRegistry;
use Faker\Factory;
use App\Helpers\EntityManagerHelper;

// use Faker\Factory;

class CitizenFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $a = 0;
        while ($a <= 10) {
            # code...
            $Citizen = new Citizen();
            $Citizen->setLastname($faker->lastName);
            $Citizen->setFirstname($faker->name);
            $Citizen->setEmail($faker->email);
            $Citizen->setPassword($faker->userName);
            $Citizen->setPassword($faker->userName);

            $Citizen->setRoles(["Citizen"]);

            $a++;
            $manager->persist($Citizen);
        }

        $manager->flush();
    }
}
