<?php

namespace App\Product\Domain\Entity;

use App\Shared\Domain\Interface\ToArrayInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

class Product implements ToArrayInterface
{
    private Uuid $id;

    private string $name;

    private string $article;

    private string $price;

    private Collection $sizes;

    private ?Description $description = null;
    
    private ?string $image = null;

    private ?string $imageTablet = null;

    private ?string $imageMobile = null;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->sizes = new ArrayCollection();
    }

    // GETTERS
    public function getId(): Uuid { return $this->id; }

    public function getName(): string { return $this->name; }

    public function getArticle(): string { return $this->article; }

    public function getPrice(): string { return $this->price; }

    public function getSizes(): Collection { return $this->sizes; }

    public function getDescription(): ?Description { return $this->description; }

    public function getImage(): ?string { return $this->image; }

    public function getImageTablet(): ?string { return $this->imageTablet; }

    public function getImageMobile(): ?string { return $this->imageMobile; }
    
    // SETTERS
    public function setName(string $name): void { $this->name = $name; }

    public function setArticle(string $article): void { $this->article = $article; }

    public function setPrice(string $price): void { $this->price = $price; }

    public function setDescription(?Description $description): void { $this->description = $description; }

    public function setImage(string $image): void { $this->image = $image; }

    public function setImageTablet(?string $imageTablet): void { $this->imageTablet = $imageTablet; }

    public function setImageMobile(?string $imageMobile): void { $this->imageMobile = $imageMobile; }
    
    public function addSize(Size $size): void
    {
        if ($this->sizes->contains($size)) return;
        $this->sizes->add($size);
    }

    public function removeSize(Size $size): void
    {
        $this->sizes->removeElement($size);
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
            'price'         => $this->getPrice(),
            'article'       => $this->getArticle(),
            'image'         => $this->getImage(),
            'description'   => $this->getDescriptionArr(),
            'sizes'         => $this->getSizesArr()
        );
    }
}
