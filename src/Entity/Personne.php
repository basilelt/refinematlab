<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    #[ORM\Column(length: 70, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 254, nullable: true)]
    private ?string $mail = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $tel = null;

    /**
     * @var Collection<int, Appareil>
     */
    #[ORM\OneToMany(targetEntity: Appareil::class, mappedBy: 'id_responsable')]
    private Collection $appareils;

    /**
     * @var Collection<int, Intervention>
     */
    #[ORM\OneToMany(targetEntity: Intervention::class, mappedBy: 'id_responsable')]
    private Collection $interventions_responsable;

    #[ORM\ManyToOne(inversedBy: 'personnes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ExterneInterne $id_externe_interne = null;

    #[ORM\ManyToOne(inversedBy: 'personnes')]
    private ?Entreprise $id_entreprise = null;

    /**
     * @var Collection<int, Intervention>
     */
    #[ORM\ManyToMany(targetEntity: Intervention::class, mappedBy: 'personnes')]
    private Collection $interventions_personnel;

    public function __construct()
    {
        $this->appareils = new ArrayCollection();
        $this->interventions_responsable = new ArrayCollection();
        $this->interventions_personnel = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): static
    {
        $this->tel = $tel;

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
            $appareil->setIdResponsable($this);
        }

        return $this;
    }

    public function removeAppareil(Appareil $appareil): static
    {
        if ($this->appareils->removeElement($appareil)) {
            // set the owning side to null (unless already changed)
            if ($appareil->getIdResponsable() === $this) {
                $appareil->setIdResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Intervention>
     */
    public function getInterventionResponsables(): Collection
    {
        return $this->interventions_responsable;
    }

    public function addInterventionResponsable(Intervention $intervention): static
    {
        if (!$this->interventions_responsable->contains($intervention)) {
            $this->interventions_responsable->add($intervention);
            $intervention->setIdResponsable($this);
        }

        return $this;
    }

    public function removeInterventionResponsable(Intervention $intervention): static
    {
        if ($this->interventions_responsable->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getIdResponsable() === $this) {
                $intervention->setIdResponsable(null);
            }
        }

        return $this;
    }

    public function getIdExterneInterne(): ?ExterneInterne
    {
        return $this->id_externe_interne;
    }

    public function setIdExterneInterne(?ExterneInterne $id_externe_interne): static
    {
        $this->id_externe_interne = $id_externe_interne;

        return $this;
    }

    public function getIdEntreprise(): ?Entreprise
    {
        return $this->id_entreprise;
    }

    public function setIdEntreprise(?Entreprise $id_entreprise): static
    {
        $this->id_entreprise = $id_entreprise;

        return $this;
    }

    /**
     * @return Collection<int, Intervention>
     */
    public function getInterventionsPersonnel(): Collection
    {
        return $this->interventions_personnel;
    }

    public function addInterventionsPersonnel(Intervention $interventionsPersonnel): static
    {
        if (!$this->interventions_personnel->contains($interventionsPersonnel)) {
            $this->interventions_personnel->add($interventionsPersonnel);
            $interventionsPersonnel->addPersonne($this);
        }

        return $this;
    }

    public function removeInterventionsPersonnel(Intervention $interventionsPersonnel): static
    {
        if ($this->interventions_personnel->removeElement($interventionsPersonnel)) {
            $interventionsPersonnel->removePersonne($this);
        }

        return $this;
    }
}
