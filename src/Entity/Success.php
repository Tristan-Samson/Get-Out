<?php

namespace App\Entity;

use App\Repository\SuccessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuccessRepository::class)
 */
class Success
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="integer")
     */
    private $reward_points;

    /**
     * @ORM\Column(type="integer")
     */
    private $reward_exp;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="successes")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getRewardPoints(): ?int
    {
        return $this->reward_points;
    }

    public function setRewardPoints(int $reward_points): self
    {
        $this->reward_points = $reward_points;

        return $this;
    }

    public function getRewardExp(): ?int
    {
        return $this->reward_exp;
    }

    public function setRewardExp(int $reward_exp): self
    {
        $this->reward_exp = $reward_exp;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }
}
