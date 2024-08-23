<?php

namespace App\User\Application\Boundary;

interface AuthorizationInteractorInterface
{
    public function logIn(array $data): string;
    public function logOut(): void;
}