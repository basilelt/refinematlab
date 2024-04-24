<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\DocumentFinancierRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Entity\Consommable;
use App\Entity\Intervention;

#[ORM\Entity(repositoryClass: DocumentFinancierRepository::class)]
#[ORM\Table(name: "document_financier")]
class DocumentFinancier
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Consommable::class)]
        #[ORM\JoinColumn(nullable: true)]
        public ?Consommable $id_consommable = null,
    
        #[ORM\ManyToOne(targetEntity: Intervention::class)]
        #[ORM\JoinColumn(nullable: true)]
        public ?Intervention $id_intervention = null,
        
        #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
        private ?string $mode_financement = null,

        #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
        private ?string $document = null,
    )
    {

    }
}
