<?php

namespace App\Product\Infrastructure\Controller;

use App\Product\Application\Boundary\ProductInteractorInterface;
use App\Product\Domain\Entity\Product;
use App\Shared\Utils\ImageToBase64Converter;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/api/product/get-products', name: 'api_get_products')]
    public function getProducts(ManagerRegistry $doctrine, KernelInterface $kernel): Response
    {
        $productRepository = $doctrine->getRepository(Product::class);
        $projectDirectory = $kernel->getProjectDir();
        
        $products = array_map(function (array $product) use ($projectDirectory) {
            $product['image'] = ImageToBase64Converter::convertImageToBase64(
                $projectDirectory . '/images/main/' . $product['image']
            );
            return $product;
        }, ProductInteractorInterface::getProductsArray($productRepository));
        
        $response = new Response(
            json_encode($products),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
        
        return $response;
    }

    #[Route('/api/product/get-product-by/{uuid}', name: 'api_get_product_by_uuid')]
    public function getProductByUuid(int $uuid, ManagerRegistry $doctrine, KernelInterface $kernel): Response
    {
        $repository = $doctrine->getRepository(Product::class);
        $projectDir = $kernel->getProjectDir();
        $product = ProductInteractorInterface::getProductByUuid($repository, $uuid);
        $file = $projectDir . '/images/main/' . $product['image'];
        $product['image'] = ImageToBase64Converter::convertImageToBase64($file);
        $response = new Response(
            'Content',
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
        $response->setContent(json_encode($product));
        return $response;
    }

}
