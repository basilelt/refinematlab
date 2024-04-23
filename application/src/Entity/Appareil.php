<?php

namespace App\Entity;

use App\Repository\AppareilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AppareilRepository::class)]
#[ORM\Table(name: "appareil")]
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
    #[Assert\Range(
        min: '1950-01-01',
        max: 'today',
        notInRangeMessage: "La date devrait être comprise entre 1950-01-01 et aujourd'hui."
    )]
    private ?\DateTimeInterface $date_achat;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[Assert\GreaterThanOrEqual(
        value: 0,
        message: 'Le prix devrait être supérieur ou égal à 0.'
    )]
    private ?string $prix_achat = '0.00';

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

    #[ORM\ManyToOne(inversedBy: 'appareils')]
    private ?Personne $id_responsable = null;

    #[ORM\ManyToOne(inversedBy: 'appareils_constructeur')]
    private ?Entreprise $id_entreprise_constructeur = null;

    #[ORM\ManyToOne(inversedBy: 'appareils_vendeur')]
    private ?Entreprise $id_entrprise_vendeur = null;

    #[ORM\ManyToOne(inversedBy: 'appareils')]
    private ?LocalisationLabo $id_localisation_labo = null;

    #[ORM\ManyToOne(inversedBy: 'appareils')]
    private ?Fonction $id_fonction = null;

    /**
     * @var Collection<int, Photo>
     */
    #[ORM\OneToMany(targetEntity: Photo::class, mappedBy: 'id_appareil')]
    private Collection $photos;

    /**
     * @var Collection<int, Intervention>
     */
    #[ORM\OneToMany(targetEntity: Intervention::class, mappedBy: 'id_appareil')]
    private Collection $interventions;

    /**
     * @var Collection<int, DocumentInformation>
     */
    #[ORM\OneToMany(targetEntity: DocumentInformation::class, mappedBy: 'id_appareil')]
    private Collection $documentInformation;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->interventions = new ArrayCollection();
        $this->documentInformation = new ArrayCollection();
        $this->date_achat = new \DateTime();
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

    public function getPrixAchat(): ?float
    // return the price as a float
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

    public function getIdResponsable(): ?Personne
    {
        return $this->id_responsable;
    }

    public function setIdResponsable(?Personne $id_responsable): static
    {
        $this->id_responsable = $id_responsable;

        return $this;
    }

    public function getIdEntrepriseConstructeur(): ?Entreprise
    {
        return $this->id_entreprise_constructeur;
    }

    public function setIdEntrepriseConstructeur(?Entreprise $id_entreprise_constructeur): static
    {
        $this->id_entreprise_constructeur = $id_entreprise_constructeur;

        return $this;
    }

    public function getIdEntrpriseVendeur(): ?Entreprise
    {
        return $this->id_entrprise_vendeur;
    }

    public function setIdEntrpriseVendeur(?Entreprise $id_entrprise_vendeur): static
    {
        $this->id_entrprise_vendeur = $id_entrprise_vendeur;

        return $this;
    }

    public function getIdLocalisationLabo(): ?LocalisationLabo
    {
        return $this->id_localisation_labo;
    }

    public function setIdLocalisationLabo(?LocalisationLabo $id_localisation_labo): static
    {
        $this->id_localisation_labo = $id_localisation_labo;

        return $this;
    }

    public function getIdFonction(): ?Fonction
    {
        return $this->id_fonction;
    }

    public function setIdFonction(?Fonction $id_fonction): static
    {
        $this->id_fonction = $id_fonction;

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): static
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setIdAppareil($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getIdAppareil() === $this) {
                $photo->setIdAppareil(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Intervention>
     */
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

    public function addIntervention(Intervention $intervention): static
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions->add($intervention);
            $intervention->setIdAppareil($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): static
    {
        if ($this->interventions->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getIdAppareil() === $this) {
                $intervention->setIdAppareil(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DocumentInformation>
     */
    public function getDocumentInformation(): Collection
    {
        return $this->documentInformation;
    }

    public function addDocumentInformation(DocumentInformation $documentInformation): static
    {
        if (!$this->documentInformation->contains($documentInformation)) {
            $this->documentInformation->add($documentInformation);
            $documentInformation->setIdAppareil($this);
        }

        return $this;
    }

    public function removeDocumentInformation(DocumentInformation $documentInformation): static
    {
        if ($this->documentInformation->removeElement($documentInformation)) {
            // set the owning side to null (unless already changed)
            if ($documentInformation->getIdAppareil() === $this) {
                $documentInformation->setIdAppareil(null);
            }
        }

        return $this;
    }
}
