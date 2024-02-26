<?php

namespace App\Entity;

use App\Repository\ChaineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChaineRepository::class)]
class Chaine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?TypeChaine $TypeChaine = null;

    #[ORM\Column]
    private ?int $Numero = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getTypeChaine(): ?TypeChaine
    {
        return $this->TypeChaine;
    }

    public function setTypeChaine(?TypeChaine $TypeChaine): static
    {
        $this->TypeChaine = $TypeChaine;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->Numero;
    }

    public function setNumero(int $Numero): static
    {
        $this->Numero = $Numero;

        return $this;
    }
}
