<?php

namespace App\Controller;

use App\Entity\DTO\CartDTO;
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
        } else {
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
        } else {
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

    #[Route('/cart/add', name: 'add_to_cart_ajax', methods: 'POST')]
    public function add_to_cart_ajax(Request $request): Response
    {
        $session = $request->getSession();
        $data = $request->toArray();

        $cart_items = [];
        $cart_item = array();
        if ($session->has('cart')) {
            $cart_items = json_decode($session->get('cart'));
            foreach ($cart_items as &$item) {
                if ($item['id'] == $data['id'] && $item['size'] == $data['size']) {
                    $item['amount'] += 1;
                    break;
                }
            }
        } else {
            $cart_item = array(
                'id'        => $data['id'],
                'amount'    => 1,
                'size'      => $data['size']
            );
            array_push($cart_items, $cart_item);
        }

        $session->set('cart', json_encode($cart_items));
        $response = new Response(
            'Content',
            Response::HTTP_OK,
        );
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode(array('content' => json_encode($cart_items))));
        return $response;
    }
}
