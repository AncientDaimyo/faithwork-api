<?php

namespace App\Shared\Application\Service;

use App\Kernel;
use App\Shared\Application\Interface\ImageServiceInterface;

class ImageService implements ImageServiceInterface
{
    protected string $projectDirectory;

    public function __construct(Kernel $kernel)
    {
        $this->projectDirectory = $kernel->getProjectDir();
    }

    public function getProductImageBase64(?string $imagePath): string
    {
        if (
            empty($imagePath)
            || !file_exists($this->projectDirectory . '/images/product/' . $imagePath)
        ) {
            return '';
        }

        return $this->convertImageToBase64(
            $this->projectDirectory . '/images/main/' . $imagePath
        );
    }

    protected function convertImageToBase64(string $filePath): string
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if (!in_array($extension, ['jpeg', 'jpg', 'gif', 'png', 'webp', 'svg'])) {
            return '';
        }

        $imageData = file_get_contents($filePath);
        $mimeType = image_type_to_mime_type(exif_imagetype($filePath));

        return 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
    }
}
