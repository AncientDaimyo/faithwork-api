<?php

namespace App\User\Application\Service;

class UserDataValidationService
{
    public static function validateUserData(array $data): array
    {
        $errors = [];
        if (empty($data['email'])) {
            $errors['email'] = 'Email is required';
        }
        if (empty($data['password'])) {
            $errors['password'] = 'Password is required';
        }
        if (empty($data['name'])) {
            $errors['name'] = 'Name is required';
        }
        return $errors;
    }
}
