<?php

namespace App\Product\Domain\Entity;

use Symfony\Component\Uid\Uuid;

class Size
{
    private Uuid $id;

    private string $size;

    // GETTERS
    public function getId(): Uuid { return $this->id; }

    public function getSize(): string { return $this->size; }

    // SETTERS
    public function setSize(string $size): void { $this->size = $size; }

    public function __toString(): string { return $this->size; }
}
