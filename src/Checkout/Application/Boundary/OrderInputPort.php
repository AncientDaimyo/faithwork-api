<?php

namespace App\Checkout\Application\Boundary;

use App\Checkout\Application\Interactor\OrderInteractor;

class OrderInputPort
{
    public static function callMakeOrder($checkoutData, $registry, $productRepository)
    {
        $interactor = new OrderInteractor();
        $interactor->makeOrder($checkoutData, $registry, $productRepository);
    }
}
