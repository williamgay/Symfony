<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
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
    private $author;
    /**
     * @ORM\Column(type="integer")
     */
    private $authorId;
    /**
     * @ORM\Column(type="integer")
     */
    private $likeCount = 0;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    public $content;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $user_id;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="boolean", options={"default: false"})
     */
    private $featured = false;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $img;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="article")
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="articles")
     */
    public $user;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getImg(): ?string
    {
        return $this->img;
    }
    public function setImg(string $img): self
    {
        return $this->img;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
    public function getUser_id(): ?int
    {
        return $this->user_id;
    }
    public function setUser_id(int $user_id)
    {
        return $this->user_id;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }
    public function getFeatured(): ?bool
    {
        return $this->featured;
    }
    public function setFeatured(bool $published)
    {
        return $this->featured;
    }
    public function getAuthor(): ?string
    {
        return $this->author;
    }
    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }
    public function getAuthorId(): ?int
    {
        return $this->authorId;
    }
    public function setAuthorId(int $authorId): self
    {
        $this->authorId = $authorId;
        return $this;
    }
    public function getLikeCount(): ?int
    {
        return $this->likeCount;
    }
    public function setLikeCount(int $likeCount): self
    {
        $this->likeCount = $likeCount;
        return $this;
    }
    public function incrementLikeCount():self
    {
        $this->likeCount = $this->likeCount + 1;
        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

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
}
