<?php

namespace App\Product\Application\Boundary;

interface ProductRepositoryInterface
{
    public function getProducts();

    public function getProductByUuid($uuid);

    public function deleteProduct($uuid);

    public function createProduct($data);

    public function updateProduct($data);
}
