<?php

namespace App\Checkout\Domain\Entity;

use App\Checkout\Domain\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
class Status
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'status', targetEntity: Order::class)]
    private Collection $order_obj;

    public function __construct()
    {
        $this->order_obj = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrderObj(): Collection
    {
        return $this->order_obj;
    }

    public function addOrderObj(Order $orderObj): static
    {
        if (!$this->order_obj->contains($orderObj)) {
            $this->order_obj->add($orderObj);
            $orderObj->setStatus($this);
        }

        return $this;
    }

    public function removeOrderObj(Order $orderObj): static
    {
        if ($this->order_obj->removeElement($orderObj)) {
            // set the owning side to null (unless already changed)
            if ($orderObj->getStatus() === $this) {
                $orderObj->setStatus(null);
            }
        }

        return $this;
    }
}
