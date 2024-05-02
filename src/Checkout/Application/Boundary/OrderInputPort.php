<?php

namespace App\Checkout\Application\Boundary;

use App\Checkout\Application\Interactor\OrderInteractor;

class OrderInputPort
{
    public static function callMakeOrder()
    {
        $interactor = new OrderInteractor();
        $interactor->makeOrder();
    }
}
