<?php

namespace App\User\Domain\Repository;

use App\User\Application\Boundary\UserRepositoryInterface;
use App\User\Application\DTO\UserDTO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\User\Domain\Entity\User;
use Symfony\Component\Uid\Uuid;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getUserByUuid(string $uuid): ?User
    {
        if (empty($uuid)) {
            return null;
        }

        try {
            $uuid = Uuid::fromString($uuid);
        } catch (\Exception $e) {
            return null;
        }

        return $this->findOneBy(['uuid' => $uuid]);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function getUserByName(string $name): ?User
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function create(UserDTO $userDTO): void
    {
        $user = new User(
            $userDTO->name,
            $userDTO->email,
            $userDTO->password
        );

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function update(UserDTO $user): void
    {
        // TODO: Implement update() method.
    }

    public function delete(string $uuid): void
    {
        // TODO: Implement delete() method.
    }
}
