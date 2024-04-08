<?php

namespace App\Controller;

use PHPUnit\TextUI\XmlConfiguration\Logging\TestDox\Html;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Product;

class CartController extends AbstractController
{
    
    #[Route('/cart', name: 'app_cart')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Product::class)->findAll();
        session_start();
        if (isset($_COOKIE["cart"])) {
            $cart = json_decode($_COOKIE["cart"]);
        }
        else {
            $cart = [];
        }
        $cart_items = [];
        if (!$products) {
            throw $this->createNotFoundException(
                'No products found'
            );
        }
        foreach ($cart as $item) {
            foreach ($products as $product) {
                if ($product->getId() == $item->id) {
                    array_push($cart_items, new Cart_Item($product, $item->amount));
                } 
            }
        }
        return $this->render('cart/index.html.twig', [
            'cart_items' => $cart_items,
        ]);
    }

    #[Route('/cart/ajax', name: 'app_cart_ajax')]
    public function index_ajax(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Product::class)->findAll();
        session_start();
        if (isset($_COOKIE["cart"])) {
            $cart = json_decode($_COOKIE["cart"]);
        }
        else {
            $cart = [];
        }
        $cart_items = [];
        if (!$products) {
            throw $this->createNotFoundException(
                'No products found'
            );
        }
        foreach ($cart as $item) {
            foreach ($products as $product) {
                if ($product->getId() == $item->id) {
                    array_push($cart_items, new Cart_Item($product, $item->amount));
                } 
            }
        }
        return $this->render('cart/ajaxindex.html.twig', [
            'cart_items' => $cart_items,
        ]);
    }

    #[Route('/cart', name: 'add_to_cart_ajax', methods: 'POST')]
    public function add_to_cart_ajax(): Response
    {
        $responseData = [
            'key1' => 'хуй',
            // Add more key-value pairs as needed
        ];
        
        $response = new JsonResponse($responseData);
        
        return new Response("хуй");
    }
}

class Cart_Item {
    public $product;
    public $amount;
    function __construct(Product $product, int $amount) {
        $this->product = $product;
        $this->amount = $amount;
    }
}