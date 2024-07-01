<?php

namespace App\Checkout\Domain\Repository;

use App\Checkout\Domain\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Checkout\Application\Boundary\OrderRepositoryInterface;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository implements OrderRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }
    public static function create($cart, $customer)
    {
        date_default_timezone_set('Europe/Moscow');

        $entityManager = $this->getManager();

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

    public static function pushOrderItem(OrderItem $orderItem, ManagerRegistry $registry)
    {

    }
//    /**
//     * @return Order[] Returns an array of Order objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Order
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
