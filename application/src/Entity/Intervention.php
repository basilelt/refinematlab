<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Personne;
use App\Entity\ExterneInterne;
use App\Entity\TypeIntervention;
use App\Entity\ModeIntervention;
use App\Entity\Appareil;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
#[ORM\Table(name: 'intervention')]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue('SEQUENCE')]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    /** @var Collection<int, Personne> */
    #[ORM\ManyToMany(targetEntity: Personne::class, inversedBy: 'interventions_personnel')]
    public Collection $personnes;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Personne::class)]
        #[ORM\JoinColumn(nullable: true)]
        public ?Personne $id_responsable = null,

        #[ORM\ManyToOne(targetEntity: ExterneInterne::class)]
        #[ORM\JoinColumn(nullable: false)]
        public ExterneInterne $id_externe_interne,

        #[ORM\ManyToOne(targetEntity: TypeIntervention::class)]
        #[ORM\JoinColumn(nullable: false)]
        public TypeIntervention $id_type_intervention,

        #[ORM\ManyToOne(targetEntity: ModeIntervention::class)]
        #[ORM\JoinColumn(nullable: false)]
        public ModeIntervention $id_mode_intervention,

        #[ORM\ManyToOne(targetEntity: Appareil::class)]
        #[ORM\JoinColumn(nullable: false)]
        public ?Appareil $id_appareil,

        #[ORM\Column(type: Types::DATETIMETZ_MUTABLE, nullable: false)]
        #[Assert\Range(
            min: '1950-01-01',
            max: 'today',
            notInRangeMessage: "La date devrait être comprise entre 1950-01-01 et aujourd'hui."
        )]
        public \DateTimeInterface $date_debut,
    
        #[ORM\Column(type: Types::DATETIMETZ_MUTABLE, nullable: true)]
        #[Assert\Range(
            min: '1950-01-01',
            max: 'today',
            notInRangeMessage: "La date devrait être comprise entre 1950-01-01 et aujourd'hui."
        )]
        public ?\DateTimeInterface $date_fin = null,
    
        #[ORM\Column(type: Types::STRING, length: 260, nullable: true)]
        public ?string $rapport = null,
    )
    {
        $this->personnes = new ArrayCollection();
    }
}
