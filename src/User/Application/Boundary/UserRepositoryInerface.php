<?php

namespace App\User\Application\Boundary;

use App\User\Application\DTO\UserDTO;
use App\User\Domain\Entity\User;

interface UserRepositoryInterface 
{
    public function getUserByUuid(string $uuid): ?User;

    public function getUserByEmail(string $email): ?User;

    public function getUserByName(string $name): ?User;

    public function create(UserDTO $user): void;

    public function update(UserDTO $user): void;

    public function delete(string $uuid): void;
}