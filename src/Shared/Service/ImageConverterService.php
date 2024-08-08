<?php

namespace App\Shared\Service;

class ImageConverterService
{
    public static function convertImageToBase64(string $filePath): string
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        
        if (in_array($extension, ['jpeg', 'jpg', 'gif', 'png', 'webp', 'svg'])) {
            $imageData = file_get_contents($filePath);
            $mimeType = image_type_to_mime_type(exif_imagetype($filePath));
            
            return 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
        }
        
        return '';
    }
}
