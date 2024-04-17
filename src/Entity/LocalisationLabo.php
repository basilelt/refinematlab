<?php

namespace App\Entity;

use App\Repository\LocalisationLaboRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocalisationLaboRepository::class)]
class LocalisationLabo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $numero_piece = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $etage_piece = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $description_piece = null;

    /**
     * @var Collection<int, Appareil>
     */
    #[ORM\OneToMany(targetEntity: Appareil::class, mappedBy: 'id_localisation_labo')]
    private Collection $appareils;

    /**
     * @var Collection<int, Consommable>
     */
    #[ORM\OneToMany(targetEntity: Consommable::class, mappedBy: 'id_localisation_labo')]
    private Collection $consommables;

    public function __construct()
    {
        $this->appareils = new ArrayCollection();
        $this->consommables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroPiece(): ?string
    {
        return $this->numero_piece;
    }

    public function setNumeroPiece(?string $numero_piece): static
    {
        $this->numero_piece = $numero_piece;

        return $this;
    }

    public function getEtagePiece(): ?string
    {
        return $this->etage_piece;
    }

    public function setEtagePiece(?string $etage_piece): static
    {
        $this->etage_piece = $etage_piece;

        return $this;
    }

    public function getDescriptionPiece(): ?string
    {
        return $this->description_piece;
    }

    public function setDescriptionPiece(?string $description_piece): static
    {
        $this->description_piece = $description_piece;

        return $this;
    }

    /**
     * @return Collection<int, Appareil>
     */
    public function getAppareils(): Collection
    {
        return $this->appareils;
    }

    public function addAppareil(Appareil $appareil): static
    {
        if (!$this->appareils->contains($appareil)) {
            $this->appareils->add($appareil);
            $appareil->setIdLocalisationLabo($this);
        }

        return $this;
    }

    public function removeAppareil(Appareil $appareil): static
    {
        if ($this->appareils->removeElement($appareil)) {
            // set the owning side to null (unless already changed)
            if ($appareil->getIdLocalisationLabo() === $this) {
                $appareil->setIdLocalisationLabo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Consommable>
     */
    public function getConsommables(): Collection
    {
        return $this->consommables;
    }

    public function addConsommable(Consommable $consommable): static
    {
        if (!$this->consommables->contains($consommable)) {
            $this->consommables->add($consommable);
            $consommable->setIdLocalisationLabo($this);
        }

        return $this;
    }

    public function removeConsommable(Consommable $consommable): static
    {
        if ($this->consommables->removeElement($consommable)) {
            // set the owning side to null (unless already changed)
            if ($consommable->getIdLocalisationLabo() === $this) {
                $consommable->setIdLocalisationLabo(null);
            }
        }

        return $this;
    }
}
