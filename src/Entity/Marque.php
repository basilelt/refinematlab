<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Appareil>
     */
    #[ORM\OneToMany(targetEntity: Appareil::class, mappedBy: 'id_marque')]
    private Collection $appareils;

    public function __construct()
    {
        $this->appareils = new ArrayCollection();
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
            $appareil->setIdMarque($this);
        }

        return $this;
    }

    public function removeAppareil(Appareil $appareil): static
    {
        if ($this->appareils->removeElement($appareil)) {
            // set the owning side to null (unless already changed)
            if ($appareil->getIdMarque() === $this) {
                $appareil->setIdMarque(null);
            }
        }

        return $this;
    }
}
