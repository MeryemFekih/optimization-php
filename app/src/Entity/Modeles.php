<?php

namespace App\Entity;

use App\Repository\ModelesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelesRepository::class)]
class Modeles
{
    #[ORM\Id]
    #[ORM\Column]
    private ?string $id = null;

    #[ORM\Column(length:255 )]
    private ?string $title = null;

    #[ORM\Column(type:"text" )]
    private ?string $description = null;

    #[ORM\Column()]
    private ?int $price = null;

    #[ORM\OneToMany(mappedBy:"modele", targetEntity: ModelesFiles::class)]
    private Collection $files;

    public function __construct()
    {
        $this->files = new ArrayCollection();
    }

}
