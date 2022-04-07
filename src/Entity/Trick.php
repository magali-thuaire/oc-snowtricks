<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use App\Repository\MediaRepository;
use App\Repository\TrickRepository;
use App\Service\UploaderHelper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
#[UniqueEntity(fields: ['title'], message: 'trick.title.unique')]
class Trick
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[NotBlank(message: 'trick.title.not_blank')]
    private $title;

    #[Gedmo\Slug(fields: ['title'])]
    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private $slug;

    #[ORM\Column(type: 'text')]
    #[NotBlank(message: 'trick.description.not_blank')]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $category;

    #[ORM\OneToOne(targetEntity: Media::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private $featuredImage;

    #[ORM\OneToMany(mappedBy: 'trick', targetEntity: Media::class, cascade: ['persist'])]
    #[ORM\OrderBy(['createdAt' => 'ASC'])]
    private $medias;

    #[ORM\OneToMany(mappedBy: 'trick', targetEntity: Comment::class, fetch: 'EXTRA_LAZY')]
    #[ORM\OrderBy(['createdAt' => 'ASC'])]
    private $comments;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'tricks')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private $author;

    public const MAX_COMMENTS_RESULT = 10;

    public function __construct()
    {
        $this->medias = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public const CATEGORY = [
        0 => 'grab',
        1 => 'spin',
        2 => 'flip and inverted rotation'
    ];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = strtolower($title);

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?int
    {
        return $this->category;
    }

    public function setCategory(int $category): self
    {

        $this->category = $category;

        return $this;
    }

    public function getCategoryName(): string
    {
        return self::CATEGORY[$this->category];
    }

    public function getFeaturedImage(): ?Media
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(?Media $featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    public function getFeaturedImagePath(): string
    {
        return UploaderHelper::TRICK_IMAGE . '/' . ($this->featuredImage?->getFile() ?? 'default.jpg');
    }

    public function isUpdated(): bool
    {
        return  !($this->createdAt == $this->updatedAt);
    }

    public function getMedias(): ?Collection
    {
        return $this->medias
            ->filter(function (Media $media) {
                return $media !== $this->featuredImage;
            })
        ;
    }

    public function getImages(): ?Collection
    {
        return $this->getMedias()?->matching(MediaRepository::createImageCriteria()) ?: null;
    }

    public function getVideos(): ?Collection
    {
        return $this->getMedias()?->matching(MediaRepository::createVideoCriteria()) ?: null;
    }

    private function getNewFeaturedImage(): ?Media
    {
         return $this->getimages()->first() ?: null;
    }

    public function setNewFeaturedImage(): self
    {
        $this->setFeaturedImage($this->getNewFeaturedImage());

        return $this;
    }

    public function addMedia(Media $media): self
    {
        if (!$this->medias->contains($media)) {
            $this->medias[] = $media;
            $media->setTrick($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): self
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getTrick() === $this) {
                $media->setTrick(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(int $multiple = 1): Collection
    {
        return $this->comments?->matching(CommentRepository::createMaxResultCriteria($multiple * self::MAX_COMMENTS_RESULT));
    }

    public function getAllComments()
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setTrick($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getTrick() === $this) {
                $comment->setTrick(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
