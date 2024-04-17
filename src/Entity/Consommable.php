<?php

namespace App\Entity;

use App\Repository\ConsommableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ConsommableRepository::class)]
#[ORM\Table(name: 'consommable')]
class Consommable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nature = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dimension = null;

    #[ORM\Column(type: Types:: SMALLINT, nullable: true)]
    #[Assert\GreaterThanOrEqual(
        value: 0,
        message: 'La quantité par lot doit être supérieure ou égale à 0'
    )]
    private ?int $quantite_par_lot = 0;

    #[ORM\Column(nullable: true)]
    private ?int $seuil = 0;

    #[ORM\Column(nullable: true)]
    private ?int $stock = 0;

    /**
     * @var Collection<int, DocumentFinancier>
     */
    #[ORM\OneToMany(targetEntity: DocumentFinancier::class, mappedBy: 'id_consommable')]
    private Collection $documentFinanciers;

    /**
     * @var Collection<int, CodeBarre>
     */
    #[ORM\OneToMany(targetEntity: CodeBarre::class, mappedBy: 'id_consommable')]
    private Collection $codeBarres;

    /**
     * @var Collection<int, DocumentInformation>
     */
    #[ORM\OneToMany(targetEntity: DocumentInformation::class, mappedBy: 'id_consommable')]
    private Collection $documentInformation;

    #[ORM\ManyToOne(inversedBy: 'consommables')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LocalisationLabo $id_localisation_labo = null;

    #[ORM\ManyToOne(inversedBy: 'consommables')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeUnite $id_type_unite = null;

    /**
     * @var Collection<int, CatalogueConsommable>
     */
    #[ORM\OneToMany(targetEntity: CatalogueConsommable::class, mappedBy: 'id_consommable')]
    private Collection $catalogueConsommables;

    /**
     * @var Collection<int, Commande>
     */
    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'id_consommable')]
    private Collection $commandes;

    public function __construct()
    {
        $this->documentFinanciers = new ArrayCollection();
        $this->codeBarres = new ArrayCollection();
        $this->documentInformation = new ArrayCollection();
        $this->catalogueConsommables = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): static
    {
        $this->nature = $nature;

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

    public function getDimension(): ?string
    {
        return $this->dimension;
    }

    public function setDimension(?string $dimension): static
    {
        $this->dimension = $dimension;

        return $this;
    }

    public function getQuantiteParLot(): ?int
    {
        return $this->quantite_par_lot;
    }

    public function setQuantiteParLot(?int $quantite_par_lot): static
    {
        $this->quantite_par_lot = $quantite_par_lot;

        return $this;
    }

    public function getSeuil(): ?int
    {
        return $this->seuil;
    }

    public function setSeuil(?int $seuil): static
    {
        $this->seuil = $seuil;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): static
    {
        $this->stock = $stock;

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
            $documentFinancier->setIdConsommable($this);
        }

        return $this;
    }

    public function removeDocumentFinancier(DocumentFinancier $documentFinancier): static
    {
        if ($this->documentFinanciers->removeElement($documentFinancier)) {
            // set the owning side to null (unless already changed)
            if ($documentFinancier->getIdConsommable() === $this) {
                $documentFinancier->setIdConsommable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CodeBarre>
     */
    public function getCodeBarres(): Collection
    {
        return $this->codeBarres;
    }

    public function addCodeBarre(CodeBarre $codeBarre): static
    {
        if (!$this->codeBarres->contains($codeBarre)) {
            $this->codeBarres->add($codeBarre);
            $codeBarre->setIdConsommable($this);
        }

        return $this;
    }

    public function removeCodeBarre(CodeBarre $codeBarre): static
    {
        if ($this->codeBarres->removeElement($codeBarre)) {
            // set the owning side to null (unless already changed)
            if ($codeBarre->getIdConsommable() === $this) {
                $codeBarre->setIdConsommable(null);
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
            $documentInformation->setIdConsommable($this);
        }

        return $this;
    }

    public function removeDocumentInformation(DocumentInformation $documentInformation): static
    {
        if ($this->documentInformation->removeElement($documentInformation)) {
            // set the owning side to null (unless already changed)
            if ($documentInformation->getIdConsommable() === $this) {
                $documentInformation->setIdConsommable(null);
            }
        }

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

    public function getIdTypeUnite(): ?TypeUnite
    {
        return $this->id_type_unite;
    }

    public function setIdTypeUnite(?TypeUnite $id_type_unite): static
    {
        $this->id_type_unite = $id_type_unite;

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
            $catalogueConsommable->setIdConsommable($this);
        }

        return $this;
    }

    public function removeCatalogueConsommable(CatalogueConsommable $catalogueConsommable): static
    {
        if ($this->catalogueConsommables->removeElement($catalogueConsommable)) {
            // set the owning side to null (unless already changed)
            if ($catalogueConsommable->getIdConsommable() === $this) {
                $catalogueConsommable->setIdConsommable(null);
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
            $commande->setIdConsommable($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getIdConsommable() === $this) {
                $commande->setIdConsommable(null);
            }
        }

        return $this;
    }
}
