<?php

namespace App\Shared\Utils;

class ImageToBase64Converter
{
    public static function parseImageToBase64($file): string
    {
        $path = pathinfo($file);
        $ext = mb_strtolower($path['extension']);
        $img = "";
        if (in_array($ext, array('jpeg', 'jpg', 'gif', 'png', 'webp', 'svg'))) {
            if ($ext == 'svg') {
                $base64_string = 'data:image/svg+xml;base64,' . base64_encode(file_get_contents($file));
            } else {
                $size = getimagesize($file);
                $base64_string = 'data:' . $size['mime'] . ';base64,' . base64_encode(file_get_contents($file));
            }
        }
        return $base64_string;
    }
}
