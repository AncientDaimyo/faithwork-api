<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;

class ShopController extends AbstractController
{
    #[Route('/shop', name: 'app_shop')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Product::class)->findAll();

        if (!$products) {
            throw $this->createNotFoundException(
                'No products found'
            );
        }
        return $this->render('shop/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/shop/{id}', name: 'app_shop_single_product')]
    public function singleProduct(ManagerRegistry $doctrine, int $id): Response
    {
        $product = $doctrine->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No products found'
            );
        }
        return $this->render('shop/single_product.html.twig', [
            'product' => $product,
        ]);
    }
}
