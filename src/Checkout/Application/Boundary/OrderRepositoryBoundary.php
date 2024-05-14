<?php

namespace App\Checkout\Application\Boundary;

use App\Checkout\Domain\Entity\Order;
use App\Checkout\Domain\Entity\OrderItem;
use App\Checkout\Domain\Entity\Status;
use DateTimeImmutable;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;

class OrderRepositoryBoundary
{
    public static function pushOrder(Order $order, ManagerRegistry $registry)
    {
        date_default_timezone_set('Europe/Moscow');
        $order->setTimeStamp(DateTimeImmutable::createFromMutable(new DateTime(date("Y-m-d H:i:s"))));
        $order->setStatus($registry->getRepository(Status::class)->find(1));

    }

    public static function pushOrderItem(OrderItem $orderItem, ManagerRegistry $registry)
    {

    }
}