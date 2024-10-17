<?php

namespace App\User\Application\Interactor;

use App\User\Application\Boundary\UserInteractorInterface;
use App\User\Domain\Repository\UserRepository;;
use App\User\Application\Factory\UserDTOFactory;
use App\User\Application\Service\UserDataValidationService;
use App\User\Application\DTO\UserDTO;

class UserInteractor implements UserInteractorInterface
{
    private UserDTOFactory $userDTOFactory;

    private UserRepository $userRepository;

    public function __construct(UserDTOFactory $userDTOFactory, UserRepository $userRepository)
    {
        $this->userDTOFactory = $userDTOFactory;
        $this->userRepository = $userRepository;
    }

    public function getAccountData(string $uuid): ?UserDTO
    {
        $accountData = $this->userDTOFactory->createFromEntity(
            $this->userRepository->getUserByUuid($uuid)
        );

        if (!$accountData) {
            return null;
        }
        
        return $accountData;
    }

    public function createAccount(array $data): array
    {
        $errors = UserDataValidationService::validateUserData($data);
        if (!empty($errors)) {
            return $errors;
        }
        
        $user = $this->userDTOFactory->create($data);
        $this->userRepository->create($user);
        return $errors;
    }
}