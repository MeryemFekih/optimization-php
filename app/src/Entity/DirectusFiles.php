<?php

namespace App\Entity;

use App\Repository\DirectusFilesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DirectusFilesRepository::class)]
class DirectusFiles
{
    #[ORM\Id]
    #[ORM\Column]
    private ?string $id = null;

    #[ORM\Column(length:255, nullable:true)]
    private ?string $storage = null;

    #[ORM\Column(length:255, nullable:true)]
    private ?string $filename_disk = null;

    

    #[ORM\Column(type:"datetime_immutable", nullable:true)]
    private ?\DateTimeImmutable $uploaded_on = null;

    public function getId(): ?string { return $this->id; }

    public function getFilenameDisk(): ?string
    {
        return $this->filename_disk;
    }
}
