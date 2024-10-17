<?php

namespace App\Shared\Application\Interface;

interface TokenServiceInterface
{
    public function generate(): string;

    public function validate(string $token): bool;
}