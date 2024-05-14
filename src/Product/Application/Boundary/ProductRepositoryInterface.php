<?php

namespace App\Product\Application\Boundary;

interface ProductRepositoryInterface
{
    public function getProducts();
    public function getProductByUuid($uuid);
}
