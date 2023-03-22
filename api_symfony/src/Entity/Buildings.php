<?php

namespace App\Entity;

use App\Repository\BuildingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuildingsRepository::class)]
class Buildings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 5)]
    private ?string $zipcode = null;

    #[ORM\ManyToOne(inversedBy: 'buildings')]
    private ?Organisations $idOrganisation = null;

    #[ORM\OneToMany(mappedBy: 'idBuildings', targetEntity: Pieces::class)]
    private Collection $pieces;

    public function __construct()
    {
        $this->pieces = new ArrayCollection();
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

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getIdOrganisation(): ?Organisations
    {
        return $this->idOrganisation;
    }

    public function setIdOrganisation(?Organisations $idOrganisation): self
    {
        $this->idOrganisation = $idOrganisation;

        return $this;
    }

    /**
     * @return Collection<int, Pieces>
     */
    public function getPieces(): Collection
    {
        return $this->pieces;
    }

    public function addPiece(Pieces $piece): self
    {
        if (!$this->pieces->contains($piece)) {
            $this->pieces->add($piece);
            $piece->setIdBuildings($this);
        }

        return $this;
    }

    public function removePiece(Pieces $piece): self
    {
        if ($this->pieces->removeElement($piece)) {
            // set the owning side to null (unless already changed)
            if ($piece->getIdBuildings() === $this) {
                $piece->setIdBuildings(null);
            }
        }

        return $this;
    }
}
