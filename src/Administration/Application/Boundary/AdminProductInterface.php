<?php

namespace App\Administration\Application\Boundary;

interface AdminProductInterface
{
    public function getProducts();

    public function getProductByUuid(string $uuid);

    public function deleteProduct(string $uuid);

    public function createProduct(array $data);

    public function updateProduct(array $data);
}
