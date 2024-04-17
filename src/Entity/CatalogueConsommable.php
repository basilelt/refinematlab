<?php

namespace App\Entity;

use App\Repository\CatalogueConsommableRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CatalogueConsommableRepository::class)]
#[ORM\Table(name: 'catalogue_consommable')] 
class CatalogueConsommable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Assert\GreaterThanOrEqual(
        value: 0,
        message: 'Le prix devrait être supérieur ou égal à 0.'
    )]
    private ?float $prix = 0;

    #[ORM\ManyToOne(inversedBy: 'catalogueConsommables')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $id_entreprise = null;

    #[ORM\ManyToOne(inversedBy: 'catalogueConsommables')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Consommable $id_consommable = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

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
