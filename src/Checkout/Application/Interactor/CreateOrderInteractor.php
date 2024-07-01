<?php

namespace App\Checkout\Application\Interactor;

use App\Checkout\Application\Boundary\OrderRepositoryInterface;
use App\Checkout\Application\DTO\CartItemDTO;
use App\Checkout\Application\DTO\CustomerDTO;

class CreateOrderInteractor
{

    /** 
     * @param OrderRepositoryInterface $repository
     * @param CartItemDTO[] $cart
     * @param CustomerDTO $customerDTO
     **/
    public static function createOrder($repository, array $cart, CustomerDTO $customerDTO): void
    {
        $repository->create($cart, $customerDTO);
    }
}
