<?php

namespace App\Checkout\Application\DTO;

class OrderItemDTO
{
    private $uuid;
    private $amount;
    private $size;

    public function __construct($uuid, $amount, $size)
    {
        $this->uuid     = $uuid;
        $this->amount   = $amount;
        $this->size     = $size;
    }

    /**
     * Get the value of uuid
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Get the value of amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the value of size
     */
    public function getSize()
    {
        return $this->size;
    }
}
