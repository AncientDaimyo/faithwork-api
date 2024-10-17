<?php

namespace App\User\Application\DTO;

class UserDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly string $name
    )
    {}
}