<?php

namespace App\Product\Application\Interface;

use App\Product\Domain\Entity\Product;
use App\Product\Application\DTO\ProductDTO;

interface ProductDTOFactoryInterface
{
    public function create(Product $product): ProductDTO;
}