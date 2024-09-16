<?php

namespace App\Administration\Application\Interactor;

use App\Administration\Application\Boundary\AdminProductInterface;
use App\Product\Application\Boundary\ProductRepositoryInterface;
use App\Product\Application\Factory\ProductDTOFactory;

class AdminProductInteractor implements AdminProductInterface
{
    protected ProductRepositoryInterface $repository;
    protected ProductDTOFactory $productDtoFactory;

    public function __construct(
        ProductRepositoryInterface $repository,
        ProductDTOFactory $productDtoFactory
    ) {
        $this->repository = $repository;
        $this->productDtoFactory = $productDtoFactory;
    }

    public function getProducts()
    {
        return $this->repository->getProducts();
    }

    public function getProductByUuid(string $uuid)
    {
        return $this->repository->getProductByUuid($uuid);
    }

    public function deleteProduct(string $uuid)
    {
        $this->repository->deleteProduct($uuid);
    }

    public function createProduct(array $data)
    {
        $this->repository->createProduct($data);
    }

    public function updateProduct(array $data)
    {
        $this->repository->updateProduct($data);
    }
}
