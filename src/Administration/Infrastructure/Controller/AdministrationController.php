<?php

namespace App\Administration\Infrastructure\Controller;

use App\Administration\Application\Boundary\AdminProductInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdministrationController extends AbstractController
{
    #[Route('/api/admin/product', name: 'api_admin_product', methods: ['GET'])]
    public function productPage(AdminProductInterface $adminProduct): Response 
    {
        $products = $adminProduct->getProducts();
        return new Response(
            json_encode($products),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }

    #[Route('/api/admin/product/{uuid}', name: 'api_admin_product_by_uuid', methods: ['GET'])]
    public function productPageByUuid(string $uuid, AdminProductInterface $adminProduct): Response 
    {
        $product = $adminProduct->getProductByUuid($uuid);
        return new Response(
            json_encode($product),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }

    #[Route('/api/admin/product', name: 'api_admin_product_delete', methods: ['DELETE'])]
    public function deleteProduct(Request $request, AdminProductInterface $adminProduct): Response 
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['uuid'])) {
            return new Response(
                json_encode(['success' => false]),
                Response::HTTP_BAD_REQUEST,
                ['content-type' => 'application/json']
            );
        }

        $adminProduct->deleteProduct($data['uuid']);
        return new Response(
            json_encode(['success' => true]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }

    #[Route('/api/admin/product', name: 'api_admin_product_create', methods: ['POST'])]
    public function createProduct(Request $request, AdminProductInterface $adminProduct): Response 
    {
        $data = json_decode($request->getContent(), true);

        $adminProduct->createProduct($data);
        return new Response(
            json_encode(['success' => true]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }

    #[Route('/api/admin/product', name: 'api_admin_product_update', methods: ['PUT'])]
    public function updateProduct(Request $request, AdminProductInterface $adminProduct): Response 
    {
        $data = json_decode($request->getContent(), true);
        $adminProduct->updateProduct($data);
        return new Response(
            json_encode(['success' => true]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
