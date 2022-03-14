<?php

namespace App\Entity;

use App\Repository\ChiefRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChiefRepository::class)]
class Chief
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $badge_number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBadgeNumber(): ?int
    {
        return $this->badge_number;
    }

    public function setBadgeNumber(int $badge_number): self
    {
        $this->badge_number = $badge_number;

        return $this;
    }
}
