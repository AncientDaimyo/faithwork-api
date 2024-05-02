<?php

namespace App\Product\Application\Interactor;

use App\Product\Application\Boundary\ProductRepositoryInterface;

class GetProductInteractor
{
    public static function getProductsArray($repository): array
    {
        $products = ProductRepositoryInterface::getProductsFromRepository($repository);
        $productsDtoArray = [];
        foreach ($products as $p) {
            array_push($productsDtoArray, $p->toArray());
        }
        return $productsDtoArray;
    }

    public static function getProductByUuid($repository, $uuid): array
    {
        $p = ProductRepositoryInterface::getProductFromRepositoryByUuid($repository, $uuid);
        return $p->toArray();
    }
}
