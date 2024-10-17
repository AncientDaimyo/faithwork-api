<?php

namespace App\User\Application\Service;

class PasswordEncryptionService
{
    public static function encrypt(string $password) : string
    {
        return md5($password);
    }

    public static function verify(string $password, string $hash) : bool
    {
        return md5($password) === $hash;
    }
}