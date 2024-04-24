<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ModeInterventionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: ModeInterventionRepository::class)]
#[ORM\Table(name: "mode_intervention")]
class ModeIntervention
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
