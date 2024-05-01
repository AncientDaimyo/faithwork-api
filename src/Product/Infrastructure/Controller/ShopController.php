<?php

namespace App\Product\Infrastructure\Controller;

use App\Product\Application\Boundary\ShopInputPort;
use App\Product\Domain\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/api/product/get-products', name: 'api_get_products')]
    public function getProducts(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Product::class);
        $products = ShopInputPort::getShopProducts($repository);
        $response = new Response(
            'Content',
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
        $response->setContent(json_encode($products));
        return $response;
    }

    #[Route('/api/product/get-product-by/{uuid}')]
    public function getProductByUuid(int $uuid, ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Product::class);
        $product = ShopInputPort::getShopProductByUuid($repository, $uuid);
        $response = new Response(
            'Content',
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
        $response->setContent(json_encode($product));
        return $response;
    }
}
