<?php

namespace App\Entity;

use App\Repository\GalaxyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GalaxyRepository::class)]
class Galaxy
{
    #[ORM\Id]
    #[ORM\Column]
    private ?string $id = null;

    #[ORM\Column(length:255)]
    private ?string $title = null;

    #[ORM\Column(type:"text")]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: Modeles::class)]
    #[ORM\JoinColumn(name:"modele", referencedColumnName:"id")]
    private ?Modeles $modele = null;

    public function getId(): ?string { return $this->id; }

    public function getModele(): ?Modeles
    {
        return $this->modele;
    }
}
