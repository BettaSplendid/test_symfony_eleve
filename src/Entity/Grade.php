<?php

namespace App\Entity;

use App\Repository\GradeRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;


#[ORM\Entity(repositoryClass: GradeRepository::class)]

class Grade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $grade;

    #[ORM\ManyToOne(targetEntity: Test::class, inversedBy: 'grades')]
    private $test;

    #[ORM\ManyToOne(targetEntity: Citizen::class, inversedBy: 'grades')]
    private $tested_citizen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?float
    {
        return $this->grade;
    }

    public function setGrade(float $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function setTest(?Test $test): self
    {
        $this->test = $test;

        return $this;
    }

    public function getTested_Citizen(): ?Citizen
    {
        return $this->tested_citizen;
    }

    public function setTested_Citizen(?Citizen $tested_citizen): self
    {
        $this->tested_citizen = $tested_citizen;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }
}
