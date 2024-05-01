<?php
namespace App\Product\Application\Boundary;

class ProductRepositoryInterface
{
    public static function getProductsFromRepository($repository)
    {
        return $repository->findAll();
    }

    public static function getProductFromRepositoryByUuid($repository, $uuid)
    {
        return $repository->findOneBy(['id' => $uuid]);
    }
}