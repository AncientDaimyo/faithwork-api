<?php

namespace App\Checkout\Application\DTO;

class OrderDTO
{

    private array $cart;

    public function __construct(array $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Get the value of cart
     */
    public function getCart()
    {
        return $this->cart;
    }
}
