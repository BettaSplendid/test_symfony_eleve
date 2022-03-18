<?php

namespace App\Entity;

use App\Repository\BrochureTestoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrochureTestoRepository::class)]
class BrochureTesto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $brochureFilename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrochureFilename(): ?string
    {
        return $this->brochureFilename;
    }

    public function setBrochureFilename(?string $brochureFilename): self
    {
        $this->brochureFilename = $brochureFilename;

        return $this;
    }
}
