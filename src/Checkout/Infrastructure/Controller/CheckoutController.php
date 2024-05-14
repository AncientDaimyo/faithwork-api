<?php

namespace App\Checkout\Infrastructure\Controller;

use App\Checkout\Domain\Entity\Address;
use App\Checkout\Domain\Entity\Customer;
use App\Checkout\Domain\Entity\Order;
use App\Checkout\Domain\Entity\OrderItem;
use App\Product\Domain\Entity\Product;
use App\Product\Domain\Entity\Size;
use App\Checkout\Infrastructure\DTO\CheckoutData;
use App\Product\Domain\Entity\Status;
use App\Shared\Utils\DataIntegrityValidator;
use DateTime;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Persistence\ManagerRegistry;

class CheckoutController extends AbstractController
{
    #[Route('/api/checkout/make-order', name: 'app_checkout', methods: ['POST'])]
    public function checkout(Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine): Response
    {
        $data       = $request->toArray();
        $keys       = array(

        );
        $integrityErrors  = DataIntegrityValidator::checkIntegrity($data, $keys);
        if ($integrityErrors == null) {
            $co_data = new CheckoutData($data);


            $errors = $this->co_data_validate($co_data, $validator);
            if (true) {
                $this->makeOrder($co_data, $doctrine);
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
            $response->setContent(json_encode(array(
                'status' => 'data integrity has been violated',
                'errors' => $integrityErrors
            )));
        }

        return $response;
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
