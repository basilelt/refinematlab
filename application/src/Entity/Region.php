<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Entity\Pays;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
#[ORM\Table(
    name: "region",
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: "idx_region_id_pays_nom", columns: ["id_pays", "nom"])
    ]
)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Pays::class)]
        #[ORM\JoinColumn(nullable: false)]
        public Pays $id_pays,

        #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
        public string $nom,
    )
    {

    }
}
