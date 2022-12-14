<?php

namespace App\Entity;

use App\Repository\RubriqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RubriqueRepository::class)]
class Rubrique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private $nom;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $color = null;

    /**
     * @var Evenement[]|Collection
     */
    #[ORM\OneToMany(mappedBy: 'rubrique', targetEntity: Evenement::class, cascade: ['persist'], orphanRemoval: false)]
    private Collection $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Evenement $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setRubrique($this);
        }

        return $this;
    }

    public function removeEvent(Evenement $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getRubrique() === $this) {
                $event->setRubrique(null);
            }
        }

        return $this;
    }
}
