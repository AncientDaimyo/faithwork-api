<?php

namespace App\Product\Application\Factory;

use App\Product\Domain\Entity\Product;
use App\Product\Application\DTO\ProductDTO;
use App\Product\Application\Interface\ProductDTOFactoryInterface;
use App\Shared\Application\Interface\ImageServiceInterface;

class ProductDTOFactory implements ProductDTOFactoryInterface
{
    /**
     * @var ImageServiceInterface
     */
    private $imageService;

    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

    public function create(Product $product): ProductDTO
    {
        return new ProductDTO(
            $product->getId(),
            $product->getName(),
            $product->getArticle(),
            $product->getSizesArr(),
            $this->imageService->getProductImageBase64($product->getImage()),
            $this->imageService->getProductImageBase64($product->getImageTablet()),
            $this->imageService->getProductImageBase64($product->getImageMobile()),
            $product->getDescriptionArr(),
            $product->getCost()
        );
    }
}