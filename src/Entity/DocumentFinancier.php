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
}
