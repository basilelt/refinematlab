<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Entity\Pays;
use App\Entity\CodePostal;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
#[ORM\Table(name: "ville")]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    /** @var Collection<int, CodePostal> */
    #[ORM\ManyToMany(targetEntity: CodePostal::class, inversedBy: 'villes')]
    #[ORM\JoinColumn(nullable: false)]
    public Collection $code_postaux;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Pays::class)]
        #[ORM\JoinColumn(nullable: false)]
        public Pays $id_pays,

        #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
        public string $nom,
    )
    {
        $this->code_postaux = new ArrayCollection();
    }
}