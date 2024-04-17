<?php

namespace App\Entity;

use App\Repository\DocumentInformationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentInformationRepository::class)]
class DocumentInformation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 260, nullable: true)]
    private ?string $document = null;

    #[ORM\ManyToOne(inversedBy: 'documentInformation')]
    private ?Appareil $id_appareil = null;

    #[ORM\ManyToOne(inversedBy: 'documentInformation')]
    private ?Consommable $id_consommable = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdAppareil(): ?Appareil
    {
        return $this->id_appareil;
    }

    public function setIdAppareil(?Appareil $id_appareil): static
    {
        $this->id_appareil = $id_appareil;

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
}
