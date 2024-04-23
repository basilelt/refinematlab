<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
#[ORM\Table(name: "ville")]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Entreprise>
     */
    #[ORM\OneToMany(targetEntity: Entreprise::class, mappedBy: 'id_ville')]
    private Collection $entreprises;

    #[ORM\ManyToOne(inversedBy: 'villes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pays $id_pays = null;

    /**
     * @var Collection<int, CodePostal>
     */
    #[ORM\ManyToMany(targetEntity: CodePostal::class, inversedBy: 'villes')]
    private Collection $code_postaux;

    public function __construct()
    {
        $this->entreprises = new ArrayCollection();
        $this->code_postaux = new ArrayCollection();
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

    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): static
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises->add($entreprise);
            $entreprise->setIdVille($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): static
    {
        if ($this->entreprises->removeElement($entreprise)) {
            // set the owning side to null (unless already changed)
            if ($entreprise->getIdVille() === $this) {
                $entreprise->setIdVille(null);
            }
        }

        return $this;
    }

    public function getIdPays(): ?Pays
    {
        return $this->id_pays;
    }

    public function setIdPays(?Pays $id_pays): static
    {
        $this->id_pays = $id_pays;

        return $this;
    }

    /**
     * @return Collection<int, CodePostal>
     */
    public function getCodePostaux(): Collection
    {
        return $this->code_postaux;
    }

    public function addCodePostaux(CodePostal $codePostaux): static
    {
        if (!$this->code_postaux->contains($codePostaux)) {
            $this->code_postaux->add($codePostaux);
        }

        return $this;
    }

    public function removeCodePostaux(CodePostal $codePostaux): static
    {
        $this->code_postaux->removeElement($codePostaux);

        return $this;
    }
}
