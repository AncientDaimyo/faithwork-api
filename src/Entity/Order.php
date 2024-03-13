<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`orders`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $order_id = null;

    #[ORM\Column]
    private ?int $customer_id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_order_placed = null;

    #[ORM\Column]
    private ?int $order_status_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $order_details = null;


    public function getOrderId(): ?int
    {
        return $this->order_id;
    }

    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $customer_id): static
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    public function getDateOrderPlaced(): ?\DateTimeImmutable
    {
        return $this->date_order_placed;
    }

    public function setDateOrderPlaced(\DateTimeImmutable $date_order_placed): static
    {
        $this->date_order_placed = $date_order_placed;

        return $this;
    }

    public function getOrderStatusCode(): ?int
    {
        return $this->order_status_code;
    }

    public function setOrderStatusCode(int $order_status_code): static
    {
        $this->order_status_code = $order_status_code;

        return $this;
    }

    public function getOrderDetails(): ?string
    {
        return $this->order_details;
    }

    public function setOrderDetails(?string $order_details): static
    {
        $this->order_details = $order_details;

        return $this;
    }

}
