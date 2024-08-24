<?php

namespace App\Shared\Application\Interface;

interface ImageServiceInterface
{
    public function getProductImageBase64(?string $imagePath): string;
}