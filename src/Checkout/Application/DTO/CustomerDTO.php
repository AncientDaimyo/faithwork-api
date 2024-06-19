<?php

namespace App\Checkout\Application\DTO;

class CustomerDTO
{
    public readonly string $name;
    public readonly string $surname;
    public readonly string $patronymic;
    public readonly string $email;
    public readonly string $telephone;
    public readonly string $city;
    public readonly string $street;
    public readonly string $house;
    public readonly string $apartment;

    public function __construct(
        string $name,
        string $surname,
        string $patronymic,
        string $email,
        string $telephone,
        string $city,
        string $street,
        string $house,
        string $apartment
    ) {
        $this->name         = $name;
        $this->surname      = $surname;
        $this->patronymic   = $patronymic;
        $this->email        = $email;
        $this->telephone    = $telephone;
        $this->city         = $city;
        $this->street       = $street;
        $this->house        = $house;
        $this->apartment    = $apartment;
    }
}

