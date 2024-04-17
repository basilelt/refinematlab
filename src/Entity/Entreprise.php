<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $adresse = null;

    /**
     * @var Collection<int, Appareil>
     */
    #[ORM\OneToMany(targetEntity: Appareil::class, mappedBy: 'id_entreprise_constructeur')]
    private Collection $appareils_constructeur;

    /**
     * @var Collection<int, Appareil>
     */
    #[ORM\OneToMany(targetEntity: Appareil::class, mappedBy: 'id_entrprise_vendeur')]
    private Collection $appareils_vendeur;

    /**
     * @var Collection<int, Personne>
     */
    #[ORM\OneToMany(targetEntity: Personne::class, mappedBy: 'id_entreprise')]
    private Collection $personnes;

    #[ORM\ManyToOne(inversedBy: 'entreprises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ville $id_ville = null;

    /**
     * @var Collection<int, CatalogueConsommable>
     */
    #[ORM\OneToMany(targetEntity: CatalogueConsommable::class, mappedBy: 'id_entreprise')]
    private Collection $catalogueConsommables;

    /**
     * @var Collection<int, Commande>
     */
    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'id_entreprise')]
    private Collection $commandes;

    public function __construct()
    {
        $this->appareils_constructeur = new ArrayCollection();
        $this->appareils_vendeur = new ArrayCollection();
        $this->personnes = new ArrayCollection();
        $this->catalogueConsommables = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Appareil>
     */
    public function getAppareils(): Collection
    {
        return $this->appareils_constructeur;
    }

    public function addAppareil(Appareil $appareil): static
    {
        if (!$this->appareils_constructeur->contains($appareil)) {
            $this->appareils_constructeur->add($appareil);
            $appareil->setIdEntrepriseConstructeur($this);
        }

        return $this;
    }

    public function removeAppareil(Appareil $appareil): static
    {
        if ($this->appareils_constructeur->removeElement($appareil)) {
            // set the owning side to null (unless already changed)
            if ($appareil->getIdEntrepriseConstructeur() === $this) {
                $appareil->setIdEntrepriseConstructeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Appareil>
     */
    public function getAppareilsVendeur(): Collection
    {
        return $this->appareils_vendeur;
    }

    public function addAppareilsVendeur(Appareil $appareilsVendeur): static
    {
        if (!$this->appareils_vendeur->contains($appareilsVendeur)) {
            $this->appareils_vendeur->add($appareilsVendeur);
            $appareilsVendeur->setIdEntrpriseVendeur($this);
        }

        return $this;
    }

    public function removeAppareilsVendeur(Appareil $appareilsVendeur): static
    {
        if ($this->appareils_vendeur->removeElement($appareilsVendeur)) {
            // set the owning side to null (unless already changed)
            if ($appareilsVendeur->getIdEntrpriseVendeur() === $this) {
                $appareilsVendeur->setIdEntrpriseVendeur(null);
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
            $personne->setIdEntreprise($this);
        }

        return $this;
    }

    public function removePersonne(Personne $personne): static
    {
        if ($this->personnes->removeElement($personne)) {
            // set the owning side to null (unless already changed)
            if ($personne->getIdEntreprise() === $this) {
                $personne->setIdEntreprise(null);
            }
        }

        return $this;
    }

    public function getIdVille(): ?Ville
    {
        return $this->id_ville;
    }

    public function setIdVille(?Ville $id_ville): static
    {
        $this->id_ville = $id_ville;

        return $this;
    }

    /**
     * @return Collection<int, CatalogueConsommable>
     */
    public function getCatalogueConsommables(): Collection
    {
        return $this->catalogueConsommables;
    }

    public function addCatalogueConsommable(CatalogueConsommable $catalogueConsommable): static
    {
        if (!$this->catalogueConsommables->contains($catalogueConsommable)) {
            $this->catalogueConsommables->add($catalogueConsommable);
            $catalogueConsommable->setIdEntreprise($this);
        }

        return $this;
    }

    public function removeCatalogueConsommable(CatalogueConsommable $catalogueConsommable): static
    {
        if ($this->catalogueConsommables->removeElement($catalogueConsommable)) {
            // set the owning side to null (unless already changed)
            if ($catalogueConsommable->getIdEntreprise() === $this) {
                $catalogueConsommable->setIdEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setIdEntreprise($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getIdEntreprise() === $this) {
                $commande->setIdEntreprise(null);
            }
        }

        return $this;
    }
}
