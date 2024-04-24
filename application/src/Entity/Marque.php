<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
#[ORM\Table(name: "marque")]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    public function __construct(
        #[ORM\Column(type: Types::STRING, length: 70, nullable: false, unique: true)]
        public string $nom,
    )
    {

    }
}
