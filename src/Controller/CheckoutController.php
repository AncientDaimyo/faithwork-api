<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\DTO\CheckoutData;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\Size;
use Doctrine\Persistence\ManagerRegistry;

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout', methods: ['POST'])]
    public function checkout(Request $request, ValidatorInterface $validator): Response
    {
        $data       = $request->toArray();
        $integrity  = $this->checkDataIntegrity($data);
        if ($integrity) {
            $co_data = new CheckoutData($data);


            $errors = $this->co_data_validate($co_data, $validator);
            if (!$errors) {
                $this->makeOrder($co_data);
                $response = new Response(
                    'Content',
                    Response::HTTP_OK,
                );
                $response->headers->set('Content-Type', 'application/json');
                $response->setContent(json_encode(array('status' => 'OK')));
            } else {
                $response = new Response(
                    'Content',
                    Response::HTTP_BAD_REQUEST,
                );
                $response->headers->set('Content-Type', 'application/json');
                $response->setContent(json_encode(array('errors' => $errors, 'status' => 'validation failed')));
            }
        } else {
            $response = new Response(
                'Content',
                Response::HTTP_BAD_REQUEST,
                ['content-type' => 'application/json']
            );
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent(json_encode(array('status' => 'data integrity has been violated')));
        }

        return $response;
    }

    private function checkDataIntegrity(array $data): bool
    {
        if (
            isset($data['name'])
            && isset($data['surname'])
            && isset($data['patronymic'])
            && isset($data['email'])
            && isset($data['telephone'])
            && isset($data['city'])
            && isset($data['street'])
            && isset($data['house'])
            && isset($data['apartment'])
            && isset($data['products'])
        ) {
            return true;
        } else {
            return false;
        }
    }
    private function co_data_validate($co_data, ValidatorInterface $validator)
    {
        $errors = $validator->validate($co_data);
        if (count($errors) > 0) {

            return $errors;
        } else {
            return false;
        }
    }
    private function makeOrder(ManagerRegistry $doctrine, CheckoutData $checkoutData): void
    {
        $entityManager = $doctrine->getManager();

        $order = new Order();
        $customer = new Customer();

        $cartItems = (array)$checkoutData['products'];
        foreach($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $product = $doctrine->getRepository(Product::class)->find($cartItem['id']);
            $orderItem->setProduct($product);
            $orderItem->setQuantity((int)$cartItem['amount']);
            $size = $doctrine->getRepository(Size::class)->find($cartItem['size']);
            $orderItem->setSize($size);
            $orderItem->setOrderObj($order);
            $order->addOrderItem($orderItem);
        }
        
        $customer->addOrder($order);


        $entityManager->persist($customer);

        $entityManager->flush();
    }
}