<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\Column(type: 'boolean')]
    private $preferred;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $beginAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $endAt;

    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?Rubrique $rubrique = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Ville $ville = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;


    public function getId(): ?int
    {
        return $this->id;
    }



    public function getPreferred(): ?bool
    {
        return $this->preferred;
    }

    public function setPreferred(bool $preferred): self
    {
        $this->preferred = $preferred;

        return $this;
    }

    public function getBeginAt(): ?\DateTime
    {
        return $this->beginAt;
    }

    public function setBeginAt(?\DateTime $beginAt): self
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    public function getEndAt(): ?\DateTime
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTime $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getRubrique(): ?Rubrique
    {
        return $this->rubrique;
    }

    public function setRubrique(?Rubrique $rubrique): self
    {
        $this->rubrique = $rubrique;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

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

}