<?php

namespace App\Entity;

use App\Repository\DescriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DescriptionRepository::class)]
class Description
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $print = null;

    #[ORM\Column(length: 255)]
    private ?string $density = null;

    #[ORM\Column(length: 255)]
    private ?string $compound = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrint(): ?string
    {
        return $this->print;
    }

    public function setPrint(string $print): static
    {
        $this->print = $print;

        return $this;
    }

    public function getDensity(): ?string
    {
        return $this->density;
    }

    public function setDensity(string $density): static
    {
        $this->density = $density;

        return $this;
    }

    public function getCompound(): ?string
    {
        return $this->compound;
    }

    public function setCompound(string $compound): static
    {
        $this->compound = $compound;

        return $this;
    }
}
