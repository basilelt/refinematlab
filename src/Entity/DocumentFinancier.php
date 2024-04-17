<?php

namespace App\Entity;

use App\Repository\DocumentFinancierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentFinancierRepository::class)]
class DocumentFinancier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $mode_financement = null;

    #[ORM\Column(length: 260, nullable: true)]
    private ?string $document = null;

    #[ORM\ManyToOne(inversedBy: 'documentFinanciers')]
    private ?Consommable $id_consommable = null;

    #[ORM\ManyToOne(inversedBy: 'documentFinanciers')]
    private ?Intervention $id_intervention = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModeFinancement(): ?string
    {
        return $this->mode_financement;
    }

    public function setModeFinancement(?string $mode_financement): static
    {
        $this->mode_financement = $mode_financement;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): static
    {
        $this->document = $document;

        return $this;
    }

    public function getIdConsommable(): ?Consommable
    {
        return $this->id_consommable;
    }

    public function setIdConsommable(?Consommable $id_consommable): static
    {
        $this->id_consommable = $id_consommable;

        return $this;
    }

    public function getIdIntervention(): ?Intervention
    {
        return $this->id_intervention;
    }

    public function setIdIntervention(?Intervention $id_intervention): static
    {
        $this->id_intervention = $id_intervention;

        return $this;
    }
}
