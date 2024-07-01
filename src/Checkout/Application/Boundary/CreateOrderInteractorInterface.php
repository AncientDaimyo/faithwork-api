<?php

namespace App\Checkout\Application\Interactor;

use App\Checkout\Application\Boundary\OrderRepositoryInterface;
use App\Checkout\Application\DTO\CustomerDTO;

interface CreateOrderInteractorInterface
{
    /** 
     * @param OrderRepositoryInterface $repository
     * @param CartItemDTO[] $cart
     * @param CustomerDTO $customerDTO
     **/
    public function createOrder(OrderRepositoryInterface $repository, array $cart, CustomerDTO $customerDTO): array;
}