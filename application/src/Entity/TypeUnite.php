<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TypeUniteRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: TypeUniteRepository::class)]
#[ORM\Table(name: "type_unite")]
class TypeUnite
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    public function __construct(
        #[ORM\Column(type: Types::STRING, length: 50, nullable: false)]
        public string $type,
    )
    {

    }
}