<?php

namespace App\Product\Application\Boundary;

use App\Product\Application\Interactor\GetProductInteractor;

class ShopInputPort
{
    public static function getShopProducts($repository): array {
        return GetProductInteractor::getProductsArray($repository);
    }

    public static function getShopProductByUuid($repository, $uuid): array {
        return GetProductInteractor::getProductByUuid($repository, $uuid);
    }
}
