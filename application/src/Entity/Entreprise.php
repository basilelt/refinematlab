<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Entity\Ville;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
#[ORM\Table(name: "entreprise")]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Ville::class)]
        #[ORM\JoinColumn(nullable: false)]
        public Ville $id_ville,
        
        #[ORM\Column(type: Types::STRING, length: 70, nullable: false)]
        public string $nom,

        #[ORM\Column(type: Types::TEXT, nullable: false)]
        public string $adresse,
    )
    {

    }
}
