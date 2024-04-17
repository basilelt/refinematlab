<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
#[ORM\Table(
    name: "region",
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: "idx_region_id_pays_nom", columns: ["id_pays", "nom"])
    ]
)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, CodePostal>
     */
    #[ORM\OneToMany(targetEntity: CodePostal::class, mappedBy: 'id_region')]
    private Collection $codePostals;

    #[ORM\ManyToOne(inversedBy: 'regions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pays $id_pays = null;

    public function __construct()
    {
        $this->codePostals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, CodePostal>
     */
    public function getCodePostals(): Collection
    {
        return $this->codePostals;
    }

    public function addCodePostal(CodePostal $codePostal): static
    {
        if (!$this->codePostals->contains($codePostal)) {
            $this->codePostals->add($codePostal);
            $codePostal->setIdRegion($this);
        }

        return $this;
    }

    public function removeCodePostal(CodePostal $codePostal): static
    {
        if ($this->codePostals->removeElement($codePostal)) {
            // set the owning side to null (unless already changed)
            if ($codePostal->getIdRegion() === $this) {
                $codePostal->setIdRegion(null);
            }
        }

        return $this;
    }

    public function getIdPays(): ?Pays
    {
        return $this->id_pays;
    }

    public function setIdPays(?Pays $id_pays): static
    {
        $this->id_pays = $id_pays;

        return $this;
    }
}
