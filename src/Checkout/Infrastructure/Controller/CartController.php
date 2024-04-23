<?php

namespace App\Checkout\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\Persistence\ManagerRegistry;
use App\Product\Domain\Entity\Product;

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

        return $this->render('cart/index.html.twig');
    }

    #[Route('/cart/ajax', name: 'app_cart_ajax')]
    public function index_ajax(Request $request, ManagerRegistry $doctrine): Response
    {
        $session = null;
        if (!$request->getSession()) {
            $session = new Session();
            $session->start();
        } else {
            $session = $request->getSession();
        }
        $products = $doctrine->getRepository(Product::class)->findAll();
        if ($session->has('cart')) {
            $cart = json_decode($session->get('cart'), true);
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
                if ($product->getId() == $item['id']) {
                    array_push($cart_items, new Cart_Item($product, $item['amount'], $item['size']));
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
        $session = null;
        if (!$request->getSession()) {
            $session = new Session();
            $session->start();
        } else {
            $session = $request->getSession();
        }
        $data = $request->toArray();

        $cart_items = [];
        $cart_item = array();
        if ($session->has('cart')) {
            $cart_item = array(
                'id'        => $data['pid'],
                'amount'    => 1,
                'size'      => $data['size']
            );
            $cart_items = json_decode($session->get('cart'), true);
            foreach ($cart_items as &$item) {
                if ($item['id'] == $data['pid'] && $item['size'] == $data['size']) {
                    $item['amount'] += 1;
                    $cart_item = false;
                    break;
                }
            }
            if ($cart_item) {
                array_push($cart_items, $cart_item);
            }
        } else {
            $cart_item = array(
                'id'        => $data['pid'],
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

    #[Route('/cart/clear', name: 'clear_cart_ajax', methods: 'DELETE')]
    public function clear_cart_ajax(Request $request): Response
    {
        $session = null;
        if (!$request->getSession()) {
            $session = new Session();
            $session->start();
        } else {
            $session = $request->getSession();
            $session->clear();
        }
        $response = new Response(
            'Content',
            Response::HTTP_OK,
        );
        return $response;
    }

    #[Route('/cart/remove', name: 'remove_from_cart_ajax', methods: 'DELETE')]
    public function remove_from__cart_ajax(Request $request): Response
    {
        $session = null;
        if (!$request->getSession()) {
            $session = new Session();
            $session->start();
        } else {
            $session = $request->getSession();
        }
        $data = $request->toArray();

        $cart_items = [];
        if ($session->has('cart')) {
            $cart_items = json_decode($session->get('cart'), true);
            foreach ($cart_items as &$item) {
                if ($item['id'] == $data['id'] && $item['size'] == $data['size']) {
                    if ($item['amount'] > 1) {
                        $item['amount'] -= 1;
                        $cart_item = false;
                    } else {
                        unset($cart_items[array_search($item, $cart_items)]);
                    }
                    break;
                }
            }
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


class Cart_Item
{
    public $product;
    public $amount;
    public $size;
    function __construct(Product $product, int $amount, string $size)
    {
        $this->product  = $product;
        $this->amount   = $amount;
        $this->size     = $size;
    }
}
