<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\LocalisationLaboRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: LocalisationLaboRepository::class)]
#[ORM\Table(name: "localisation_labo")]
class LocalisationLabo
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    public function __construct(
        #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
        public ?string $numero_piece = null,
    
        #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
        public ?string $etage_piece = null,
    
        #[ORM\Column(type: Types::STRING, length: 150, nullable: true)]
        public ?string $description_piece = null,
    )
    {

    }
}
