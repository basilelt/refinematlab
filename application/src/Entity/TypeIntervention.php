<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TypeInterventionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: TypeInterventionRepository::class)]
#[ORM\Table(name: "type_intervention")]
class TypeIntervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    public function __construct(
        #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
        public string $description,
    )
    {

    }
}