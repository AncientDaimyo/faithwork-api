<?php

namespace App\Product\Infrastructure\Controller;

use App\Product\Application\Boundary\ProductInteractorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
    public function getProducts(ProductInteractorInterface $productInteractor): Response
    {
        $products = $productInteractor->getProducts();

        return new Response(
            json_encode($products),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }

    #[Route(
        '/api/product/get-product-by/{uuid}',
        name: 'api_get_product_by_uuid',
        methods: ['GET'],
    )]
    public function getProductByUuid(string $uuid, ProductInteractorInterface $productInteractor): Response
    {
        $product = $productInteractor->getProductByUuid($uuid);

        return new Response(
            json_encode($product),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
