<?php

namespace App\User\Application\Boundary;

interface AccountInteractorInterface
{
    public function getAccountData(string $uuid): array; 

    public function updateAccount(array $data);

    public function deleteAccount();

    public function recoverPassword(array $data);

    public function changePassword(array $data);
}
