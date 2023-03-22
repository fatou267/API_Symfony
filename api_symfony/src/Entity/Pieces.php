<?php

namespace App\Entity;

use App\Repository\PiecesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PiecesRepository::class)]
class Pieces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?int $presonnes_presentes = null;

    #[ORM\ManyToOne(inversedBy: 'pieces')]
    private ?Buildings $idBuildings = null;

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

    public function getPresonnesPresentes(): ?int
    {
        return $this->presonnes_presentes;
    }

    public function setPresonnesPresentes(?int $presonnes_presentes): self
    {
        $this->presonnes_presentes = $presonnes_presentes;

        return $this;
    }

    public function getIdBuildings(): ?Buildings
    {
        return $this->idBuildings;
    }

    public function setIdBuildings(?Buildings $idBuildings): self
    {
        $this->idBuildings = $idBuildings;

        return $this;
    }
}
