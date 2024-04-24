<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
#[ORM\Table(name: 'pays')]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    public function __construct(
        #[ORM\Column(type: Types::SMALLINT, nullable: true, unique: true)]
        #[Assert\Range(
            min: 1,
            max: 999,
            notInRangeMessage: 'Le code numérique devrait être compris entre 1 et 999.'
        )]
        public ?int $code_num = null,
    
        #[ORM\Column(type: Types::STRING, length: 2, nullable: true, unique: true)]
        public ?string $code_alpha2 = null,
    
        #[ORM\Column(type: Types::STRING, length: 3, nullable: true, unique: true)]
        public ?string $code_alpha3 = null,
    
        #[ORM\Column(type: Types::STRING, length: 255, nullable: true, unique: true)]
        public ?string $nom_francais = null,
    
        #[ORM\Column(type: Types::STRING, length: 255, nullable: true, unique: true)]
        public ?string $nom_anglais = null,
    )
    {

    }
}
