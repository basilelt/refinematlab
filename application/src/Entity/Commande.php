<?php



namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ORM\Table(name: 'commande')]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Assert\GreaterThanOrEqual(
        value: 0,
        message: 'Le prix unitaire devrait être supérieur ou égal à 0.'
    )]
    private ?string $prix_unitaire = '0.00';

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\GreaterThanOrEqual(
        value: 0,
        message: 'Le nombre de lot devrait être supérieur ou égal à 0.'
    )]
    private ?int $nombre_lot = 0;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    #[Assert\Range(
        min: '1950-01-01',
        max: 'today',
        notInRangeMessage: "La date devrait être comprise entre 1950-01-01 et aujourd'hui."
    )]
    private ?\DateTimeInterface $date_commande;

    #[ORM\Column]
    private ?bool $reception = false;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE, nullable: true)]
    #[Assert\Range(
        min: '1950-01-01',
        max: 'today',
        notInRangeMessage: "La date devrait être comprise entre 1950-01-01 et aujourd'hui."
    )]
    private ?\DateTimeInterface $date_reception = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Consommable $id_consommable = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $id_entreprise = null;

    public function __construct()
    {
        $this->date_commande = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixUnitaire(): ?float
    // return the price as a float
    {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(string $prix_unitaire): static
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }

    public function getNombreLot(): ?int
    {
        return $this->nombre_lot;
    }

    public function setNombreLot(int $nombre_lot): static
    {
        $this->nombre_lot = $nombre_lot;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): static
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function isReception(): ?bool
    {
        return $this->reception;
    }

    public function setReception(bool $reception): static
    {
        $this->reception = $reception;

        return $this;
    }

    public function getDateReception(): ?\DateTimeInterface
    {
        return $this->date_reception;
    }

    public function setDateReception(?\DateTimeInterface $date_reception): static
    {
        $this->date_reception = $date_reception;
    
        if ($this->reception && $this->date_reception && $this->date_reception <= new \DateTime()) {
            $this->id_consommable->setStock(
                $this->id_consommable->getStock() + $this->nombre_lot * $this->id_consommable->getQuantiteParLot()
            );
        }
    
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

    public function getIdEntreprise(): ?Entreprise
    {
        return $this->id_entreprise;
    }

    public function setIdEntreprise(?Entreprise $id_entreprise): static
    {
        $this->id_entreprise = $id_entreprise;

        return $this;
    }
}
