<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\OneToMany(targetEntity=Work::class, mappedBy="owner", orphanRemoval=true)
     */
    private $works;

    /**
     * @ORM\OneToMany(targetEntity=UserLikedPosts::class, mappedBy="user", orphanRemoval=true)
     */
    private $userLikedPosts;

    public function __construct()
    {
        $this->works = new ArrayCollection();
        $this->userLikedPosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection|Work[]
     */
    public function getWorks(): Collection
    {
        return $this->works;
    }

    public function addWork(Work $work): self
    {
        if (!$this->works->contains($work)) {
            $this->works[] = $work;
            $work->setOwner($this);
        }

        return $this;
    }

    public function removeWork(Work $work): self
    {
        if ($this->works->removeElement($work)) {
            // set the owning side to null (unless already changed)
            if ($work->getOwner() === $this) {
                $work->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserLikedPosts[]
     */
    public function getUserLikedPosts(): Collection
    {
        return $this->userLikedPosts;
    }

    public function addUserLikedPost(UserLikedPosts $userLikedPost): self
    {
        if (!$this->userLikedPosts->contains($userLikedPost)) {
            $this->userLikedPosts[] = $userLikedPost;
            $userLikedPost->setUser($this);
        }

        return $this;
    }

    public function removeUserLikedPost(UserLikedPosts $userLikedPost): self
    {
        if ($this->userLikedPosts->removeElement($userLikedPost)) {
            // set the owning side to null (unless already changed)
            if ($userLikedPost->getUser() === $this) {
                $userLikedPost->setUser(null);
            }
        }

        return $this;
    }
}
