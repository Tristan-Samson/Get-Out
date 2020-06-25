<?php

namespace App\Entity;

use App\Repository\ValidationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ValidationRepository::class)
 */
class Validation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $ValidationDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="validations")
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity=Quest::class, inversedBy="validations")
     */
    private $quests;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_valid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValidationDate(): ?\DateTimeInterface
    {
        return $this->ValidationDate;
    }

    public function setValidationDate(\DateTimeInterface $ValidationDate): self
    {
        $this->ValidationDate = $ValidationDate;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getQuests(): ?Quest
    {
        return $this->quests;
    }

    public function setQuests(?Quest $quests): self
    {
        $this->quests = $quests;

        return $this;
    }

    public function getIsValid(): ?bool
    {
        return $this->is_valid;
    }

    public function setIsValid(bool $is_valid): self
    {
        $this->is_valid = $is_valid;

        return $this;
    }
}
