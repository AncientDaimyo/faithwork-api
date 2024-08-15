<?php

namespace App\Product\Application\Boundary;

use App\Product\Application\DTO\ProductDTO;

interface ProductInteractorInterface
{
    public function getProducts(): array;
    public function getProductByUuid(string $uuid): ProductDTO;
}
