<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private $file;

    #[ORM\Column(type: 'integer')]
    private $type;

    #[ORM\ManyToOne(targetEntity: Trick::class, inversedBy: 'medias')]
    #[ORM\JoinColumn(onDelete: 'cascade')]
    private $trick;

    public const TYPE = ['image', 'video'];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function getFilePath(): ?string
    {
        return UploaderHelper::TRICK_IMAGE . '/' . $this->getFile();
    }
    public function getAvatarPath(): ?string
    {
        return UploaderHelper::AVATAR_IMAGE . '/' . $this->getFile();
    }

    public function setFile(string $file): self
    {
        $this->file = strtolower($file);

        return $this;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;

        return $this;
    }
}
