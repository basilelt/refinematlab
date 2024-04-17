<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(length: 260, nullable: true)]
    private ?string $rapport = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?Personne $id_responsable = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ExterneInterne $id_externe_interne = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeIntervention $id_type_intervention = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ModeIntervention $id_mode_intervention = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Appareil $id_appareil = null;

    /**
     * @var Collection<int, DocumentFinancier>
     */
    #[ORM\OneToMany(targetEntity: DocumentFinancier::class, mappedBy: 'id_intervention')]
    private Collection $documentFinanciers;

    /**
     * @var Collection<int, Personne>
     */
    #[ORM\ManyToMany(targetEntity: Personne::class, inversedBy: 'interventions_personnel')]
    private Collection $personnes;

    public function __construct()
    {
        $this->documentFinanciers = new ArrayCollection();
        $this->personnes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getRapport(): ?string
    {
        return $this->rapport;
    }

    public function setRapport(?string $rapport): static
    {
        $this->rapport = $rapport;

        return $this;
    }

    public function getIdResponsable(): ?Personne
    {
        return $this->id_responsable;
    }

    public function setIdResponsable(?Personne $id_responsable): static
    {
        $this->id_responsable = $id_responsable;

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

    public function getIdTypeIntervention(): ?TypeIntervention
    {
        return $this->id_type_intervention;
    }

    public function setIdTypeIntervention(?TypeIntervention $id_type_intervention): static
    {
        $this->id_type_intervention = $id_type_intervention;

        return $this;
    }

    public function getIdModeIntervention(): ?ModeIntervention
    {
        return $this->id_mode_intervention;
    }

    public function setIdModeIntervention(?ModeIntervention $id_mode_intervention): static
    {
        $this->id_mode_intervention = $id_mode_intervention;

        return $this;
    }

    public function getIdAppareil(): ?Appareil
    {
        return $this->id_appareil;
    }

    public function setIdAppareil(?Appareil $id_appareil): static
    {
        $this->id_appareil = $id_appareil;

        return $this;
    }

    /**
     * @return Collection<int, DocumentFinancier>
     */
    public function getDocumentFinanciers(): Collection
    {
        return $this->documentFinanciers;
    }

    public function addDocumentFinancier(DocumentFinancier $documentFinancier): static
    {
        if (!$this->documentFinanciers->contains($documentFinancier)) {
            $this->documentFinanciers->add($documentFinancier);
            $documentFinancier->setIdIntervention($this);
        }

        return $this;
    }

    public function removeDocumentFinancier(DocumentFinancier $documentFinancier): static
    {
        if ($this->documentFinanciers->removeElement($documentFinancier)) {
            // set the owning side to null (unless already changed)
            if ($documentFinancier->getIdIntervention() === $this) {
                $documentFinancier->setIdIntervention(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getPersonnes(): Collection
    {
        return $this->personnes;
    }

    public function addPersonne(Personne $personne): static
    {
        if (!$this->personnes->contains($personne)) {
            $this->personnes->add($personne);
        }

        return $this;
    }

    public function removePersonne(Personne $personne): static
    {
        $this->personnes->removeElement($personne);

        return $this;
    }
}
