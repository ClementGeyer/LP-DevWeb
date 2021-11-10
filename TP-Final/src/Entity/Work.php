<?php

namespace App\Entity;

use App\Repository\WorkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkRepository::class)
 */
class Work
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="blob")
     */
    private $file;

    /**
     * @ORM\Column(type="integer")
     */
    private $likeCount;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="works")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=UserLikedPosts::class, mappedBy="post", orphanRemoval=true)
     */
    private $userLikedPosts;

    public function __construct()
    {
        $this->userLikedPosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setLikeCount($likeCount): self
    {
        $this->likeCount = $likeCount;

        return $this;
    }

    public function getLikeCount()
    {
        return $this->likeCount;
    }

    public function addLikeCount()
    {
        $this->likeCount = $this->likeCount + 1;

        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    public function setFile($file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

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
            $userLikedPost->setPost($this);
        }

        return $this;
    }

    public function removeUserLikedPost(UserLikedPosts $userLikedPost): self
    {
        if ($this->userLikedPosts->removeElement($userLikedPost)) {
            // set the owning side to null (unless already changed)
            if ($userLikedPost->getPost() === $this) {
                $userLikedPost->setPost(null);
            }
        }

        return $this;
    }
}
