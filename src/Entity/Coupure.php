<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\CoupureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;


#[ORM\Entity(repositoryClass: CoupureRepository::class)]
#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
class Coupure
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $reference;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $publishedAt;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coupureName = null;

    #[Assert\Image(
        maxSize: '2M',
        mimeTypes: ['image/*', 'application/pdf', 'application/x-pdf'],
        maxSizeMessage: "Le fichier ne doit pas dépasser 2 Mo",
        mimeTypesMessage: "Ce format n'est pas accepté (image ou pdf)",
    )]
    #[Vich\UploadableField(mapping: 'coupures', fileNameProperty: 'coupureName')]
    private ?File $coupureFile = null;

    public function getCoupureFile(): ?File
    {
        return $this->coupureFile;
    }

    public function setCoupureFile(?File $coupureFile): void
    {
        if (null !== $coupureFile) {
            $this->updatedAt = new \DateTime();
        }

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

    public function getPublishedAt(): ?\DateTime
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTime $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getCoupureName(): ?string
    {
        return $this->coupureName;
    }

    public function setCoupureName(?string $coupureName): self
    {
        $this->coupureName = $coupureName;

        return $this;
    }
}
