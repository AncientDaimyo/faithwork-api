<?php

namespace App\Shared\Application\Service;

use App\Shared\Application\Interface\TokenServiceInterface;

class TokenService implements TokenServiceInterface
{

    public function generate(): string
    {
        $secretKey = $_ENV['APP_SECRET'];
        $token = bin2hex(random_bytes(32));
        $token = hash_hmac('sha256', $token, $secretKey);
        return $token;
    }

    public function validate(string $token): bool
    {
        $secretKey = $_ENV['APP_SECRET'];
        $token = hash_hmac('sha256', $token, $secretKey);
        return hash_equals($token, $token);
    }
}