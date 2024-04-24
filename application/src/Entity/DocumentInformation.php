<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\DocumentInformationRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Entity\Appareil;
use App\Entity\Consommable;

#[ORM\Entity(repositoryClass: DocumentInformationRepository::class)]
#[ORM\Table(name: "document_information")]
class DocumentInformation
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Appareil::class)]
        #[ORM\JoinColumn(nullable: true)]
        public ?Appareil $id_appareil = null,
    
        #[ORM\ManyToOne(targetEntity: Consommable::class)]
        #[ORM\JoinColumn(nullable: true)]
        public ?Consommable $id_consommable = null,

        #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
        public ?string $document = null,
    )
    {

    }
}
