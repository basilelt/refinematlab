<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ConsommableRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\LocalisationLabo;
use App\Entity\TypeUnite;

#[ORM\Entity(repositoryClass: ConsommableRepository::class)]
#[ORM\Table(name: 'consommable')]
class Consommable
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: LocalisationLabo::class)]
        #[ORM\JoinColumn(nullable: false)]
        public LocalisationLabo $id_localisation_labo,
    
        #[ORM\ManyToOne(targetEntity: TypeUnite::class)]
        #[ORM\JoinColumn(nullable: false)]
        public TypeUnite $id_type_unite,

        #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
        public string $nature,
    
        #[ORM\Column(type: Types::TEXT, nullable: true)]
        public ?string $description = null,
    
        #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
        public ?string $dimension = null,
    
        #[ORM\Column(type: Types:: SMALLINT, nullable: true)]
        #[Assert\GreaterThanOrEqual(
            value: 0,
            message: 'La quantité par lot doit être supérieure ou égale à 0'
        )]
        public ?int $quantite_par_lot = 0,
    
        #[ORM\Column(type: Types::INTEGER, nullable: true)]
        public ?int $seuil = 0,
    
        #[ORM\Column(type: Types::INTEGER, nullable: true)]
        public ?int $stock = 0,
    )
    {

    }
}
