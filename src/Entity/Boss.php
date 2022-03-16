<?php

namespace App\Entity;

use App\Repository\BossRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BossRepository::class)]
class Boss extends Citizen
{
    #[ORM\Column(type: 'integer', length: 255)]
    private $Badge_Number;

    public function getBadgeNumber(): ?int
    {
        return $this->Badge_Number;
    }

    public function setBadgeNumber(int $Badge_Number): self
    {
        $this->Badge_Number = $Badge_Number;

        return $this;
    }

}
