<?php

namespace App\Checkout\Application\DTO;

final class CartItemDTO
{
    public readonly string $uuid;
    public readonly int $amount;
    public readonly string $size;

    public function __construct($uuid, $amount, $size)
    {
        $this->uuid     = $uuid;
        $this->amount   = $amount;
        $this->size     = $size;
    }
}
