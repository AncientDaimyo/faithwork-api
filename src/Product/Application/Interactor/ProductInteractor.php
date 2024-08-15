<?php

namespace App\Product\Application\Interactor;

use App\Product\Application\Boundary\ProductRepositoryInterface;
use App\Product\Application\Boundary\ProductInteractorInterface;
use App\Product\Application\DTO\ProductDTO;
use App\Product\Application\Factory\ProductDTOFactory;

class ProductInteractor implements ProductInteractorInterface
{
    private ProductRepositoryInterface $repository;
    private ProductDTOFactory $productDtoFactory;

    public function __construct(
        ProductRepositoryInterface $repository,
        ProductDTOFactory $productDtoFactory
    ) {
        $this->repository = $repository;
        $this->productDtoFactory = $productDtoFactory;
    }

    public function getProducts(): array
    {
        $products = $this->repository->getProducts();

        $productsDtoArray = [];
        foreach ($products as $p) {
            array_push($productsDtoArray, $this->productDtoFactory->create($p));
        }

        return $productsDtoArray;
    }

    public function getProductByUuid(string $uuid): ProductDTO
    {
        $product = $this->repository->getProductByUuid($uuid);
        return $this->productDtoFactory->create($product);
    }
}
