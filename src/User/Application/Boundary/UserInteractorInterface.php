<?php

namespace App\User\Application\Boundary;

use App\User\Application\DTO\UserDTO;

interface UserInteractorInterface
{
    public function getAccountData(string $uuid): ?UserDTO; 
    public function createAccount(array $data): array;
}
