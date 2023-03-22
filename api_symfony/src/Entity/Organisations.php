<?php

namespace App\Entity;

use App\Repository\OrganisationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrganisationsRepository::class)]
class Organisations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'idOrganisation', targetEntity: Buildings::class)]
    private Collection $buildings;

    public function __construct()
    {
        $this->buildings = new ArrayCollection();
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
     * @return Collection<int, Buildings>
     */
    public function getBuildings(): Collection
    {
        return $this->buildings;
    }

    public function addBuilding(Buildings $building): self
    {
        if (!$this->buildings->contains($building)) {
            $this->buildings->add($building);
            $building->setIdOrganisation($this);
        }

        return $this;
    }

    public function removeBuilding(Buildings $building): self
    {
        if ($this->buildings->removeElement($building)) {
            // set the owning side to null (unless already changed)
            if ($building->getIdOrganisation() === $this) {
                $building->setIdOrganisation(null);
            }
        }

        return $this;
    }
}
