<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: '`products`')]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $article = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $cost = null;

    #[ORM\Column]
    private ?array $storage = [];

    #[ORM\Column(nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: OrderItem::class)]
    private Collection $orderItems;

    #[ORM\ManyToMany(targetEntity: Size::class, inversedBy: 'products')]
    private Collection $sizes;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_tablet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_mobile = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Description $description = null;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
        $this->sizes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(string $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(string $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getStorage(): array
    {
        return $this->storage;
    }

    public function setStorage(array $storage): static
    {
        $this->storage = $storage;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): static
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems->add($orderItem);
            $orderItem->setProduct($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getProduct() === $this) {
                $orderItem->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Size>
     */
    public function getSizes(): Collection
    {
        return $this->sizes;
    }

    public function addSize(Size $size): static
    {
        if (!$this->sizes->contains($size)) {
            $this->sizes->add($size);
        }

        return $this;
    }

    public function removeSize(Size $size): static
    {
        $this->sizes->removeElement($size);

        return $this;
    }

    public function getImageTablet(): ?string
    {
        return $this->image_tablet;
    }

    public function setImageTablet(?string $image_tablet): static
    {
        $this->image_tablet = $image_tablet;

        return $this;
    }

    public function getImageMobile(): ?string
    {
        return $this->image_mobile;
    }

    public function setImageMobile(?string $image_mobile): static
    {
        $this->image_mobile = $image_mobile;

        return $this;
    }

    public function getDescription(): ?Description
    {
        return $this->description;
    }

    public function setDescription(?Description $description): static
    {
        $this->description = $description;

        return $this;
    }
}
