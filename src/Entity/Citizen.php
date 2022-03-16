<?php

namespace App\Entity;

use App\Repository\CitizenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Boss;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn('role_type', "string")]
#[ORM\DiscriminatorMap(['citizen' => 'Citizen', 'boss' => 'Boss'])]

#[ORM\Entity(repositoryClass: CitizenRepository::class)]

class Citizen 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'json')]
    private $roles;

    #[ORM\OneToMany(mappedBy: 'tested_citizen', targetEntity: Grade::class)]
    private $grades;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'Mentor')]
    private $Mentored;

    #[ORM\OneToMany(mappedBy: 'Mentored', targetEntity: self::class)]
    private $Mentor;

    #[ORM\ManyToMany(targetEntity: Study::class, inversedBy: 'citizens')]
    private $studies;

    public function __construct()
    {
        $this->grades = new ArrayCollection();
        $this->Mentor = new ArrayCollection();
        $this->studies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection<int, Grade>
     */
    public function getTest(): Collection
    {
        return $this->test;
    }

    public function addTest(Grade $test): self
    {
        if (!$this->test->contains($test)) {
            $this->test[] = $test;
        }

        return $this;
    }

    public function removeTest(Grade $test): self
    {
        if ($this->test->removeElement($test)) {
            // set the owning side to null (unless already changed)

        }

        return $this;
    }

    /**
     * @return Collection<int, Grade>
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    public function addGrade(Grade $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->setTestedCitizen($this);
        }

        return $this;
    }

    public function removeGrade(Grade $grade): self
    {
        if ($this->grades->removeElement($grade)) {
            // set the owning side to null (unless already changed)
            if ($grade->getTestedCitizen() === $this) {
                $grade->setTestedCitizen(null);
            }
        }

        return $this;
    }

    public function getMentored(): ?self
    {
        return $this->Mentored;
    }

    public function setMentored(?self $Mentored): self
    {
        $this->Mentored = $Mentored;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMentor(): Collection
    {
        return $this->Mentor;
    }

    public function addMentor(self $mentor): self
    {
        if (!$this->Mentor->contains($mentor)) {
            $this->Mentor[] = $mentor;
            $mentor->setMentored($this);
        }

        return $this;
    }

    public function removeMentor(self $mentor): self
    {
        if ($this->Mentor->removeElement($mentor)) {
            // set the owning side to null (unless already changed)
            if ($mentor->getMentored() === $this) {
                $mentor->setMentored(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Study>
     */
    public function getStudies(): Collection
    {
        return $this->studies;
    }

    public function addStudy(Study $study): self
    {
        if (!$this->studies->contains($study)) {
            $this->studies[] = $study;
        }

        return $this;
    }

    public function removeStudy(Study $study): self
    {
        $this->studies->removeElement($study);

        return $this;
    }
}
