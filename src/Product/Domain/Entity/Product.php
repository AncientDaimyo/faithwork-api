<?php

namespace App\Product\Domain\Entity;

use App\Product\Domain\Repository\ProductRepository;
use App\Shared\Domain\Interface\ToArrayInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: '`products`')]
class Product implements ToArrayInterface
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $article = null;


    #[ORM\Column(nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Size::class, inversedBy: 'products')]
    private Collection $sizes;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_tablet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_mobile = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Description $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $cost = null;

    public function __construct()
    {
        $this->sizes = new ArrayCollection();
    }

    public function getId(): ?Uuid
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

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(string $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getDescriptionArr(): array
    {
        $descriptionJson = array(
            'print'     => $this->description->getPrint(),
            'density'   => $this->description->getDensity(),
            'compound'  => $this->description->getCompound()
        );
        return $descriptionJson;
    }
    public function getSizesArr(): array
    {
        $sizes = [];
        foreach ($this->sizes as $size) {
            array_push($sizes, $size->getSize());
        }
        return $sizes;
    }

    public function toArray(): array 
    {
        return array(
            'uuid'          => $this->getId(),
            'name'          => $this->getName(),
            'cost'          => $this->getCost(),
            'article'       => $this->getArticle(),
            'image'         => $this->getImage(),
            'description'   => $this->getDescriptionArr(),
            'sizes'         => $this->getSizesArr()
        );
    }
}
