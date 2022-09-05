<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private ?string $message;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $prenom;

    #[ORM\Column(type: 'integer')]
    private ?int $age;

    #[ORM\ManyToOne(targetEntity: Rubrique::class, inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rubrique $rubrique;

    #[ORM\Column(type: 'boolean')]
    private boolean $validate;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function isValidate(): ?bool
    {
        return $this->validate;
    }

    public function setValidate(?bool $validate): self
    {
        $this->validate = $validate;

        return $this;
    }

}
