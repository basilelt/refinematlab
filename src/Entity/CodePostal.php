<?php

namespace App\Entity;

use App\Repository\CodePostalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CodePostalRepository::class)]
#[ORM\Table(
    name: "code_postal",
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: "idx_code_postal_id_region_code_postal", columns: ["id_region", "code_postal"])
    ]
)]
class CodePostal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $code_postal = null;

    #[ORM\ManyToOne(inversedBy: 'codePostals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Region $id_region = null;

    /**
     * @var Collection<int, Ville>
     */
    #[ORM\ManyToMany(targetEntity: Ville::class, mappedBy: 'code_postaux')]
    private Collection $villes;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getIdRegion(): ?Region
    {
        return $this->id_region;
    }

    public function setIdRegion(?Region $id_region): static
    {
        $this->id_region = $id_region;

        return $this;
    }

    /**
     * @return Collection<int, Ville>
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): static
    {
        if (!$this->villes->contains($ville)) {
            $this->villes->add($ville);
            $ville->addCodePostaux($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): static
    {
        if ($this->villes->removeElement($ville)) {
            $ville->removeCodePostaux($this);
        }

        return $this;
    }
}
