<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $code_num = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $code_alpha2 = null;

    #[ORM\Column(length: 3, nullable: true)]
    private ?string $code_alpha3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_francais = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_anglais = null;

    /**
     * @var Collection<int, Ville>
     */
    #[ORM\OneToMany(targetEntity: Ville::class, mappedBy: 'id_pays')]
    private Collection $villes;

    /**
     * @var Collection<int, Region>
     */
    #[ORM\OneToMany(targetEntity: Region::class, mappedBy: 'id_pays')]
    private Collection $regions;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
        $this->regions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeNum(): ?int
    {
        return $this->code_num;
    }

    public function setCodeNum(?int $code_num): static
    {
        $this->code_num = $code_num;

        return $this;
    }

    public function getCodeAlpha2(): ?string
    {
        return $this->code_alpha2;
    }

    public function setCodeAlpha2(?string $code_alpha2): static
    {
        $this->code_alpha2 = $code_alpha2;

        return $this;
    }

    public function getCodeAlpha3(): ?string
    {
        return $this->code_alpha3;
    }

    public function setCodeAlpha3(?string $code_alpha3): static
    {
        $this->code_alpha3 = $code_alpha3;

        return $this;
    }

    public function getNomFrancais(): ?string
    {
        return $this->nom_francais;
    }

    public function setNomFrancais(?string $nom_francais): static
    {
        $this->nom_francais = $nom_francais;

        return $this;
    }

    public function getNomAnglais(): ?string
    {
        return $this->nom_anglais;
    }

    public function setNomAnglais(?string $nom_anglais): static
    {
        $this->nom_anglais = $nom_anglais;

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
            $ville->setIdPays($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): static
    {
        if ($this->villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getIdPays() === $this) {
                $ville->setIdPays(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Region>
     */
    public function getRegions(): Collection
    {
        return $this->regions;
    }

    public function addRegion(Region $region): static
    {
        if (!$this->regions->contains($region)) {
            $this->regions->add($region);
            $region->setIdPays($this);
        }

        return $this;
    }

    public function removeRegion(Region $region): static
    {
        if ($this->regions->removeElement($region)) {
            // set the owning side to null (unless already changed)
            if ($region->getIdPays() === $this) {
                $region->setIdPays(null);
            }
        }

        return $this;
    }
}
