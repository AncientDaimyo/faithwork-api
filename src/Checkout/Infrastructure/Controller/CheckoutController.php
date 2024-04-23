<?php

namespace App\Checkout\Infrastructure\Controller;

use App\Checkout\Domain\Entity\Address;
use App\Checkout\Domain\Entity\Customer;
use App\Checkout\Domain\Entity\Order;
use App\Checkout\Domain\Entity\OrderItem;
use App\Product\Domain\Entity\Product;
use App\Product\Domain\Entity\Size;
use App\Checkout\Domain\DTO\CheckoutData;
use App\Product\Domain\Entity\Status;
use DateTime;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use Throwable;

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout', methods: ['POST'])]
    public function checkout(Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine): Response
    {
        $data       = $request->toArray();
        $integrity  = $this->checkDataIntegrity($data);
        $cart = [];
        $session = null;
        if (!$request->getSession()) {
            $session = new Session();
            $session->start();
        } else {
            $session = $request->getSession();
        }
        if ($session->has('cart')) {
            $cart = json_decode($session->get('cart'), true);
        }
        if ($integrity && $this->cartNotEmpty($request)) {
            $co_data = new CheckoutData($data);


            $errors = $this->co_data_validate($co_data, $validator);
            if (true) {
                $this->makeOrder($co_data, $doctrine, $cart);
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
    private function cartNotEmpty(Request $request): bool
    {
        $session = null;
        if (!$request->getSession()) {
            $session = new Session();
            $session->start();
        } else {
            $session = $request->getSession();
        }
        if ($session->has('cart')) {
            $cart = json_decode($session->get('cart'), true);
            if (!empty($cart)) {
                return true;
            }
        } else {
            return false;
        }
    }
    private function makeOrder(CheckoutData $checkoutData, ManagerRegistry $doctrine, array $cart): bool
    {
        date_default_timezone_set('Europe/Moscow');

        $entityManager = $doctrine->getManager();

        $order = new Order();

        $address = new Address();
        $address->setCity($checkoutData->getCity());
        $address->setStreet($checkoutData->getStreet());
        $address->setHouse($checkoutData->getHouse());
        $address->setApartment($checkoutData->getApartment());
        $entityManager->persist($address);

        $customer = new Customer();
        $customer->setName($checkoutData->getName());
        $customer->setSurname($checkoutData->getSurname());
        $customer->setPatronymic($checkoutData->getPatronymic());
        $customer->setEmail($checkoutData->getEmail());
        $customer->setTelephone($checkoutData->getTelephone());
        $customer->setAddress($address);

        $cartItems = $cart;
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->setProduct($doctrine->getRepository(Product::class)->findOneBy(['id' => $cartItem['id']]));
            $orderItem->setQuantity((int)$cartItem['amount']);
            $orderItem->setSize($doctrine->getRepository(Size::class)->findOneBy(['size' => $cartItem['size']]));
            $orderItem->setOrderObj($order);
            $order->addOrderItem($orderItem);
            $entityManager->persist($orderItem);
        }

        $order->setTimeStamp(DateTimeImmutable::createFromMutable(new DateTime(date("Y-m-d H:i:s"))));
        $order->setStatus($doctrine->getRepository(Status::class)->find(1));

        $customer->addOrder($order);
        $entityManager->persist($order);
        $entityManager->persist($customer);
        $entityManager->flush();
        return true;
    }
}
