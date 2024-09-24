<?php

namespace App\Product\Application\DTO;

class ProductDTO 
{
    public readonly string $uuid;
    public readonly string $name;
    public readonly string $article;
    public readonly array $sizes;
    public readonly ?string $image;
    public readonly ?string $image_tablet;
    public readonly ?string $image_mobile;
    public readonly array $description;
    public readonly string $cost;

    public function __construct(
        string $uuid,
        string $name,
        string $article,
        array $sizes,
        /**
         * TODO: изменить явное присваивание null
         */
        ?string $image = null,
        ?string $image_tablet = null,
        ?string $image_mobile = null,
        array $description = ['print' => '', 'density' => '', 'compound' => ''],
        string $cost
    )
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->article = $article;
        $this->image = $image;
        $this->sizes = $sizes;
        $this->image_tablet = $image_tablet;
        $this->image_mobile = $image_mobile;
        $this->description = $description;
        $this->cost = $cost;
    }
}