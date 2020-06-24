<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 */
class Character
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Hair_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Chest_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Legs_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $health;

    /**
     * @ORM\Column(type="integer")
     */
    private $total_exp;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="avatar")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Equipement::class, mappedBy="characters")
     */
    private $equipements;

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHairId(): ?int
    {
        return $this->Hair_id;
    }

    public function setHairId(int $Hair_id): self
    {
        $this->Hair_id = $Hair_id;

        return $this;
    }

    public function getChestId(): ?int
    {
        return $this->Chest_id;
    }

    public function setChestId(int $Chest_id): self
    {
        $this->Chest_id = $Chest_id;

        return $this;
    }

    public function getLegsId(): ?int
    {
        return $this->Legs_id;
    }

    public function setLegsId(int $Legs_id): self
    {
        $this->Legs_id = $Legs_id;

        return $this;
    }

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(int $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getTotalExp(): ?int
    {
        return $this->total_exp;
    }

    public function setTotalExp(int $total_exp): self
    {
        $this->total_exp = $total_exp;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Equipement[]
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): self
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements[] = $equipement;
            $equipement->addCharacter($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): self
    {
        if ($this->equipements->contains($equipement)) {
            $this->equipements->removeElement($equipement);
            $equipement->removeCharacter($this);
        }

        return $this;
    }
}
