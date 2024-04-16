<?php

namespace App\Entity;

use App\Repository\AppareilRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppareilRepository::class)]
class Appareil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $numero_serie = null;

    #[ORM\ManyToOne(inversedBy: 'appareils')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marque $id_marque = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_achat = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $prix_achat = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $numero_inventaire_interne = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $etat_fonctionnement = null;

    #[ORM\Column(length: 260, nullable: true)]
    private ?string $protocole_utilisation = null;

    #[ORM\Column(length: 260, nullable: true)]
    private ?string $manuel_fournisseur = null;

    #[ORM\Column(length: 260, nullable: true)]
    private ?string $fiche_securite = null;

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

    public function getNumeroSerie(): ?string
    {
        return $this->numero_serie;
    }

    public function setNumeroSerie(string $numero_serie): static
    {
        $this->numero_serie = $numero_serie;

        return $this;
    }

    public function getIdMarque(): ?Marque
    {
        return $this->id_marque;
    }

    public function setIdMarque(?Marque $id_marque): static
    {
        $this->id_marque = $id_marque;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->date_achat;
    }

    public function setDateAchat(?\DateTimeInterface $date_achat): static
    {
        $this->date_achat = $date_achat;

        return $this;
    }

    public function getPrixAchat(): ?string
    {
        return $this->prix_achat;
    }

    public function setPrixAchat(?string $prix_achat): static
    {
        $this->prix_achat = $prix_achat;

        return $this;
    }

    public function getNumeroInventaireInterne(): ?string
    {
        return $this->numero_inventaire_interne;
    }

    public function setNumeroInventaireInterne(?string $numero_inventaire_interne): static
    {
        $this->numero_inventaire_interne = $numero_inventaire_interne;

        return $this;
    }

    public function getEtatFonctionnement(): ?string
    {
        return $this->etat_fonctionnement;
    }

    public function setEtatFonctionnement(?string $etat_fonctionnement): static
    {
        $this->etat_fonctionnement = $etat_fonctionnement;

        return $this;
    }

    public function getProtocoleUtilisation(): ?string
    {
        return $this->protocole_utilisation;
    }

    public function setProtocoleUtilisation(?string $protocole_utilisation): static
    {
        $this->protocole_utilisation = $protocole_utilisation;

        return $this;
    }

    public function getManuelFournisseur(): ?string
    {
        return $this->manuel_fournisseur;
    }

    public function setManuelFournisseur(?string $manuel_fournisseur): static
    {
        $this->manuel_fournisseur = $manuel_fournisseur;

        return $this;
    }

    public function getFicheSecurite(): ?string
    {
        return $this->fiche_securite;
    }

    public function setFicheSecurite(?string $fiche_securite): static
    {
        $this->fiche_securite = $fiche_securite;

        return $this;
    }
}
