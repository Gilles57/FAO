<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $photoName = null;

    private ?File $photoFile;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    private ?Post $post = null;

    public function getPhotoFile(): ?File
    {
        return $this->photoFile;
    }

    public function setPhotoFile($photoFile): void
    {
        $this->photoFile = $photoFile;
    }

       public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoName(): ?string
    {
        return $this->photoName;
    }

    public function setPhotoName(?string $photoName): self
    {
        $this->photoName = $photoName;
        $this->uploadedAt = new \DateTime();

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

}
