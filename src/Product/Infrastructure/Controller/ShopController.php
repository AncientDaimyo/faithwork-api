<?php

namespace App\Product\Infrastructure\Controller;

use App\Product\Application\Boundary\ProductInteractorInterface;
use App\Product\Domain\Repository\ProductRepository;
use App\Shared\Service\ImageConverterService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

class ShopController extends AbstractController
{
    #[Route(
        '/api/product/get-products',
        name: 'api_get_products',
        methods: ['GET'],
    )]
    #[OA\Response(
        response: 200,
        description: 'Returns products list',
    )]
    public function getProducts(
        ManagerRegistry $doctrine,
        KernelInterface $kernel,
        ProductInteractorInterface $productInteractor
    ): Response {
        $productRepository = new ProductRepository($doctrine);
        $projectDirectory = $kernel->getProjectDir();

        $products = array_map(function (array $product) use ($projectDirectory) {
            $product['image'] = ImageConverterService::convertImageToBase64(
                $projectDirectory . '/images/main/' . $product['image']
            );
            return $product;
        }, $productInteractor->getProductsArray($productRepository));

        $response = new Response(
            json_encode($products),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );

        return $response;
    }

    #[Route(
        '/api/product/get-product-by/{uuid}',
        name: 'api_get_product_by_uuid',
        methods: ['GET'],
    )]
    public function getProductByUuid(string $uuid, ManagerRegistry $doctrine, KernelInterface $kernel, ProductInteractorInterface $productInteractor): Response
    {
        $productRepository = new ProductRepository($doctrine);
        $projectDir = $kernel->getProjectDir();
        $product = $productInteractor->getProductByUuid($productRepository, $uuid);
        $file = $projectDir . '/images/main/' . $product['image'];
        $product['image'] = ImageConverterService::convertImageToBase64($file);
        $response = new Response(
            'Content',
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
        $response->setContent(json_encode($product));
        return $response;
    }
}
