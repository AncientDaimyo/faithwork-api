<?php

namespace App\Product\Domain\Entity;

use Symfony\Component\Uid\Uuid;

class Description
{
    private Uuid $id;

    private ?string $print = null;

    private ?string $density = null;

    private ?string $compound = null;


    public function __construct()
    {
        $this->id = Uuid::v4();
    }
    // GETTERS
    public function getId(): Uuid { return $this->id; }

    public function getPrint(): ?string { return $this->print; }

    public function getDensity(): ?string { return $this->density; }

    public function getCompound(): ?string { return $this->compound; }

    // SETTERS
    public function setPrint(string $print): void { $this->print = $print; }

    public function setDensity(string $density): void { $this->density = $density; }

    public function setCompound(string $compound): void { $this->compound = $compound; }

    public function __toString(): string
    {
        $string = 'Принт: ' . $this->print . ' Плотность: ' . $this->density . ' Состав: ' . $this->compound;
        return $string;
    }
}
