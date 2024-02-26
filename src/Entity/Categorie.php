<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;


    #[ORM\Column]
    private ?int $NombreChaine = null;

    #[ORM\Column]
    private ?float $Prix = null;

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

    

    public function isNombreChaine(): ?int
    {
        return $this->NombreChaine;
    }

    public function setNombreChaine(int $NombreChaine): static
    {
        $this->NombreChaine = $NombreChaine;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }
    public function __toString(){
        return $this->Nom;
    }
}
