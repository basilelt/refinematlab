<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Entity\ExterneInterne;
use App\Entity\Entreprise;
use App\Entity\Intervention;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
#[ORM\Table(name: "personne")]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    /** @var Collection<int, Intervention> */
    #[ORM\ManyToMany(targetEntity: Intervention::class, mappedBy: 'personnes')]
    public Collection $interventions_personnes;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: ExterneInterne::class)]
        #[ORM\JoinColumn(nullable: false)]
        public ExterneInterne $id_externe_interne,
    
        #[ORM\ManyToOne(targetEntity: Entreprise::class)]
        #[ORM\JoinColumn(nullable: true)]
        public ?Entreprise $id_entreprise = null,

        #[ORM\Column(type: Types::STRING, length: 70, nullable: false)]
        public string $nom,

        #[ORM\Column(type: Types::STRING, length: 70, nullable: true)]
        public ?string $prenom = null,

        #[ORM\Column(type: Types::STRING, length: 254, nullable: true)]
        public ?string $mail = null,

        #[ORM\Column(type: Types::STRING, length: 15, nullable: true)]
        public ?string $tel = null,
    )
    {
        if ($id_externe_interne->getType() === 'interne' && $id_entreprise !== null) {
            throw new \InvalidArgumentException('id_entreprise doit être NULL pour id_externe_interne interne');
        }
    
        if ($id_externe_interne->getType() === 'externe' && $id_entreprise === null) {
            throw new \InvalidArgumentException('id_entreprise ne doit pas être NULL pour id_externe_interne externe');
        }

        $this->interventions_personnes = new ArrayCollection();
    }
}
