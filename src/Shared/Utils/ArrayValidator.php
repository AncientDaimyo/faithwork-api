<?php

namespace App\Shared\Utils;

class ArrayValidator
{
    public static function validateKeys(array $data, array $requiredKeys): ?array
    {
        $errors = [];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                $errors[] = "Key {$key} not found.";
            }
        }

        return $errors ?: null;
    }
}
