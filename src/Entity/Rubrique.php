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

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'rubrique', targetEntity: Commentaire::class, orphanRemoval: true)]
    private $commentaires;

    #[ORM\OneToMany(mappedBy: 'rubrique', targetEntity: Evenement::class)]
    private Collection $points;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->points = new ArrayCollection();
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

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setRubrique($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getRubrique() === $this) {
                $commentaire->setRubrique(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getPoints(): Collection
    {
        return $this->points;
    }

    public function addPoint(Evenement $point): self
    {
        if (!$this->points->contains($point)) {
            $this->points->add($point);
            $point->setRubrique($this);
        }

        return $this;
    }

    public function removePoint(Evenement $point): self
    {
        if ($this->points->removeElement($point)) {
            // set the owning side to null (unless already changed)
            if ($point->getRubrique() === $this) {
                $point->setRubrique(null);
            }
        }

        return $this;
    }
}
