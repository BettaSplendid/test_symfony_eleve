<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Grade;
use App\Repository\TestRepository;

class GradeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $grade = new Grade();
        // $grade->setGrade = rand();
        // // $grade->setTest($testo);
        // // $grade->setTestedCitizen();
        // $manager->persist($grade);

        // $manager->flush();
    }
}
