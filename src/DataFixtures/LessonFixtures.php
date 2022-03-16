<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Lesson;

class LessonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $a = 0;
        while ($a <= 10) {
            # code...
            $Lesson = new Lesson();
            $Lesson->setStart($faker->dateTime);
            $Lesson->setFinish($faker->dateTime);
            $Lesson->setName($faker->company);
            $a++;
            
            $manager->persist($Lesson);
            $manager->flush();
        }

    }
}
