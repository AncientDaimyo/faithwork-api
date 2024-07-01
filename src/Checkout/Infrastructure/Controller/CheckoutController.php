<?php

namespace App\Checkout\Infrastructure\Controller;

use App\Checkout\Application\DTO\CartItemDTO;
use App\Checkout\Application\DTO\CustomerDTO;
use App\Checkout\Application\Interactor\CreateOrderInteractorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Checkout\Domain\Repository\OrderRepository;

class CheckoutController extends AbstractController
{
    #[Route('/api/checkout/make-order', name: 'app_checkout', methods: ['POST'])]
    public function checkout(
        Request $request,
        CreateOrderInteractorInterface $createOrderInteractor,
        ManagerRegistry $doctrine
    ): Response {
        $data = $request->toArray();
        $orderRepository = new OrderRepository($doctrine);
        $cart = [];
        foreach ($data['cart'] as $cartItem) {
            array_push($cart, new CartItemDTO($cartItem['id'], $cartItem['amount'], $cartItem['size']));
        };
        $customer = new CustomerDTO(
            $data['name'],
            $data['patronymic'],
            $data['surname'],
            $data['email'],
            $data['telephone'],
            $data['city'],
            $data['street'],
            $data['house'],
            $data['apartment']
        );
        $createOrderInteractor->createOrder($orderRepository, $cart, $customer);
        $response = new Response(
            Response::HTTP_OK
        );
        return $response;
    }
}
