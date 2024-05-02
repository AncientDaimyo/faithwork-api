<?php

namespace App\Product\Infrastructure\Controller;

use App\Product\Application\Boundary\ShopInputPort;
use App\Product\Domain\Entity\Product;
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
        $repository = $doctrine->getRepository(Product::class);
        $projectDir = $kernel->getProjectDir();
        $products = ShopInputPort::getShopProducts($repository);
        foreach($products as &$p){
            $file = $projectDir . '/images/main/'. $p['image'];
            $path = pathinfo($file);
            $ext = mb_strtolower($path['extension']);
            $img = "";
            if (in_array($ext, array('jpeg', 'jpg', 'gif', 'png', 'webp', 'svg'))) {
                if ($ext == 'svg') {
                    $img = 'data:image/svg+xml;base64,' . base64_encode(file_get_contents($file));
                } else {
                    $size = getimagesize($file);
                    $img = 'data:' . $size['mime'] . ';base64,' . base64_encode(file_get_contents($file));
                }
            }
            $p['image'] = $img;
        }
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
