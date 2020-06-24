<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\ManyToMany(targetEntity=Success::class, mappedBy="users")
     */
    private $successes;

    /**
     * @ORM\OneToOne(targetEntity=Character::class, mappedBy="user")
     */
    private $avatar;

    public function __construct()
    {
        $this->successes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return Collection|Success[]
     */
    public function getSuccesses(): Collection
    {
        return $this->successes;
    }

    public function addSuccess(Success $success): self
    {
        if (!$this->successes->contains($success)) {
            $this->successes[] = $success;
            $success->addUser($this);
        }

        return $this;
    }

    public function removeSuccess(Success $success): self
    {
        if ($this->successes->contains($success)) {
            $this->successes->removeElement($success);
            $success->removeUser($this);
        }

        return $this;
    }

    public function getAvatar(): ?Character
    {
        return $this->avatar;
    }

    public function setAvatar(?Character $avatar): self
    {
        $this->avatar = $avatar;

        // set (or unset) the owning side of the relation if necessary
        $newUser = null === $avatar ? null : $this;
        if ($avatar->getUser() !== $newUser) {
            $avatar->setUser($newUser);
        }

        return $this;
    }
}
