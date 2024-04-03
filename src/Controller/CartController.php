<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
    #[Route('cart/', name: 'add_to_cart_ajax', methods: ['POST'])]
    public function add_to_cart_ajax(): Response
    {
        $responseData = [
            'key1' => 'хуй',
            // Add more key-value pairs as needed
        ];
        
        $response = new JsonResponse($responseData);
        return $response;
    }
}
