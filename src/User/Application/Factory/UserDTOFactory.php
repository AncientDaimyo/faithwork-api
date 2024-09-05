<?php

namespace App\User\Application\Factory;

use App\User\Application\DTO\UserDTO;
use App\User\Application\Service\PasswordEncryptionService;
use App\User\Domain\Entity\User;

class UserDTOFactory
{
    public function __construct() {}
    public function create(array $data): UserDTO
    {
        return new UserDTO(
            $data['email'],
            PasswordEncryptionService::encrypt($data['password']),
            $data['name']
        );
    }

    public function createFromEntity(?User $user): ?UserDTO
    {
        return $user ? new UserDTO($user->getEmail(), $user->getPassword(), $user->getName()) : null;
    }
}
