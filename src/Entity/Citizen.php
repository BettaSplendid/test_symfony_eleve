<?php

namespace App\Entity;

use App\Repository\CitizenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Boss;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Table(name: 'citizen')]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn('role_type', "string")]
#[ORM\DiscriminatorMap(['citizen' => 'Citizen', 'boss' => 'Boss'])]

#[ORM\Entity(repositoryClass: CitizenRepository::class)]

class Citizen implements UserInterface, PasswordAuthenticatedUserInterface
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
    private $pupils;

    #[ORM\OneToMany(mappedBy: 'pupils', targetEntity: self::class)]
    private $Mentor;

    #[ORM\ManyToMany(targetEntity: Lesson::class, inversedBy: 'citizens')]
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

    // public function getRoles(): ?array
    // {
    //     return $this->roles;
    // }

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
            $grade->setTested_Citizen($this);
        }

        return $this;
    }

    public function removeGrade(Grade $grade): self
    {
        if ($this->grades->removeElement($grade)) {
            // set the owning side to null (unless already changed)
            if ($grade->getTested_Citizen() === $this) {
                $grade->setTested_Citizen(null);
            }
        }

        return $this;
    }

    public function getpupils(): ?self
    {
        return $this->pupils;
    }

    public function setpupils(?self $pupils): self
    {
        $this->pupils = $pupils;

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
            $mentor->setpupils($this);
        }

        return $this;
    }

    public function removeMentor(self $mentor): self
    {
        if ($this->Mentor->removeElement($mentor)) {
            // set the owning side to null (unless already changed)
            if ($mentor->getpupils() === $this) {
                $mentor->setpupils(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function getStudies(): Collection
    {
        return $this->studies;
    }

    public function addLesson(Lesson $lesson): self
    {
        if (!$this->studies->contains($lesson)) {
            $this->studies[] = $lesson;
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): self
    {
        $this->studies->removeElement($lesson);

        return $this;
    }

    public function __toString()
    {
        return $this->lastname . $this->firstname;
    }
    
    public function eraseCredentials()
    {
        
    }

    public function getUserIdentifier(): string
    {
        return $this;
    } 

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

}
