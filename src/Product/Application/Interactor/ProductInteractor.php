<?php

namespace App\Product\Application\Interactor;

use App\Product\Application\Boundary\ProductRepositoryInterface;
use App\Product\Application\Boundary\ProductInteractorInterface;
use App\Shared\Domain\Service\EntityToArrayService;

class ProductInteractor implements ProductInteractorInterface
{
    public static function getProductsArray(ProductRepositoryInterface $repository): array
    {
        $products = $repository->getProducts();
        $productsDtoArray = [];
        foreach ($products as $p) {
            array_push($productsDtoArray, $p->toArray());
        }
        return $productsDtoArray;
    }

    public static function getProductByUuid(ProductRepositoryInterface $repository, $uuid): array
    {
        $p = $repository->getProductByUuid($uuid);
        return EntityToArrayService::toArray($p);
    }
}
