<?php

namespace App\Entity;

use App\Repository\CoupureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CoupureRepository::class)]
#[Vich\Uploadable]
class Coupure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $reference;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $publishedAt;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $coupure;

    #[Vich\UploadableField(mapping: 'coupures', fileNameProperty: 'coupure')]
    private ?File $coupureFile = null;

    /**
     * @return ?File
     */
    public function getCoupureFile(): ?File
    {
        return $this->coupureFile;
    }

    /**
     * @param File|null $coupureFile
     */
    public function setCoupureFile(?File $coupureFile): void
    {
        $this->coupureFile = $coupureFile;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeImmutable $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getCoupure(): ?string
    {
        return $this->coupure;
    }

    public function setCoupure(string $coupure): self
    {
        $this->coupure = $coupure;

        return $this;
    }
}
