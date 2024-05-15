<?php

namespace App\Product\Domain\Entity;

use App\Product\Domain\Repository\DescriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: DescriptionRepository::class)]
class Description
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $print = null;

    #[ORM\Column(length: 255)]
    private ?string $density = null;

    #[ORM\Column(length: 255)]
    private ?string $compound = null;

    public function getId(): ?Uuid
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

    public function __toString(): string
    {
        $string = 'Принт: ' . $this->print . ' Плотность: ' . $this->density . ' Состав: ' . $this->compound;
        return $string;
    }
}
