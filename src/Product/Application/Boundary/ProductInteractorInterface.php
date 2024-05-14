<?php

namespace App\Product\Application\Boundary;

interface ProductInteractorInterface
{
    public static function getProductsArray(ProductRepositoryInterface $repository): array;

    public static function getProductByUuid(ProductRepositoryInterface $repository, $uuid): array;
}
