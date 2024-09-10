<?php

namespace App\User\Application\Interactor;

use App\User\Application\Boundary\AccountInteractorInterface;
use App\User\Domain\Repository\UserRepository;
use App\User\Application\Factory\UserDTOFactory;
use App\User\Application\Service\UserDataValidationService;
use App\User\Application\DTO\UserDTO;

class AccountInteractor implements AccountInteractorInterface
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

    public function register(array $data): array
    {
        $errors = UserDataValidationService::validateUserData($data);
        if (!empty($errors)) {
            return $errors;
        }
        
        $user = $this->userDTOFactory->create($data);
        $this->userRepository->create($user);
        return $errors;
    }

    public function updateAccount(array $data)
    {
        // TODO realize update account
    }

    public function deleteAccount()
    {
        // TODO realize delete account
    }

    public function recoverPassword(array $data)
    {
        // TODO realize recover password
    }

    public function changePassword(array $data)
    {
        // TODO realize change password
    }
}