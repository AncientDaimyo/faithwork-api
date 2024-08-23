<?php

namespace App\User\Domain\Entity;

use Symfony\Component\Uid\Uuid;

class Customer
{
    private Uuid $uuid;

    private string $name;

    private string $email;

    private string $password;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = md5($password);

        return $this;
    }
}


