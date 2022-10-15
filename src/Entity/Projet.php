<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\ProjetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
class Projet
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'text')]
    private ?string $description;

    #[ORM\Column( length: 255)]
    private ?string $illustrationName  = null;

    #[Assert\Image(
        maxSize: '1M',
        mimeTypes: ['image/*'],
        maxSizeMessage: "Le fichier ne doit pas dépasser 1 Mo",
        mimeTypesMessage: "Ce format n'est pas accepté",
    )]
    #[Vich\UploadableField(mapping: 'illustrations', fileNameProperty: 'illustrationName')]
    private ?File $illustrationFile = null;

    public function getIllustrationFile(): ?File
    {
        return $this->illustrationFile;
    }

    public function setIllustrationFile(?File $illustrationFile): void
    {
        $this->illustrationFile = $illustrationFile;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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


    public function getIllustrationName(): ?string
    {
        return $this->illustrationName;
    }

    public function setIllustrationName(?string $illustrationName): self
    {
        $this->illustrationName = $illustrationName;

        return $this;
    }
}
