<?php

namespace App\User\Application\Boundary;

use App\User\Application\DTO\UserDTO;

interface AccountInteractorInterface
{
    public function getAccountData(string $uuid): ?UserDTO; 

    public function updateAccount(array $data);

    public function deleteAccount();

    public function recoverPassword(array $data);

    public function changePassword(array $data);
}
