<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Entity\Appareil;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
#[ORM\Table(name: "photo")]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Appareil::class)]
        #[ORM\JoinColumn(nullable: false)]
        public Appareil $id_appareil,

        #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
        public string $photo,
    )
    {

    }
}