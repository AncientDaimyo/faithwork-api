<?php

namespace App\Checkout\Application\Boundary;

use App\Checkout\Application\DTO\CustomerDTO;

interface OrderRepositoryInterface
{
    public static function create(array $cart, CustomerDTO $customerDTO);
}