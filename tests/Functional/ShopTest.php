<?php

namespace App\Tests\Functional\Controller;

use App\Product\Application\Boundary\ProductRepositoryInterface;
use App\Product\Domain\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShopTest extends WebTestCase
{
    public function test_api_get_products(): void
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/api/product/get-products'
        );
        $r = $client->getResponse();
        $r = $r->getContent();
        $this->assertResponseIsSuccessful($r);
    }

    public function test_product_repo_interface(): void {
        $repo = $doctrine->getRepository(Product::class);
        $products =ProductRepositoryInterface::getProductsFromRepository($repo);
        $this->assertEquals($doctrine->getRepository(Product::class)->findAll(),$products);
    }
}
