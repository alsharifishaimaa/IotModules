<?php

namespace App\Entity;

use App\Repository\UnitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: UnitRepository::class)]
#[UniqueEntity('nomModule')]
#[UniqueEntity('typeModule')]

class Unit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 5)]
    #[Assert\NotBlank()]
    private string $nomModule = '';

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 5)]
    #[Assert\NotBlank()]
    private string $typeModule = '';

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private string $description = '';

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private string $etatModule = '';

    #[ORM\Column(length: 255)]
    private string $donneesMesurees = '';

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatededAt = null;

    #[ORM\ManyToOne(inversedBy: 'units')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomModule(): string
    {
        return $this->nomModule;
    }

    public function setNomModule(string $nomModule): static
    {
        $this->nomModule = $nomModule;

        return $this;
    }

    public function getTypeModule(): string
    {
        return $this->typeModule;
    }

    public function setTypeModule(string $typeModule): static
    {
        $this->typeModule = $typeModule;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getEtatModule(): string
    {
        return $this->etatModule;
    }

    public function setEtatModule(string $etatModule): static
    {
        $this->etatModule = $etatModule;

        return $this;
    }

    public function getDonneesMesurees(): string
    {
        return $this->donneesMesurees;
    }

    public function setDonneesMesurees(string $donneesMesurees): static
    {
        $this->donneesMesurees = $donneesMesurees;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatededAt(): ?\DateTimeImmutable
    {
        return $this->updatededAt;
    }

    public function setUpdatededAt(\DateTimeImmutable $updatededAt): static
    {
        $this->updatededAt = $updatededAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
