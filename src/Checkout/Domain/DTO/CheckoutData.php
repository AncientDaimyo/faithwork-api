<?php

namespace App\Checkout\Domain\DTO;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class CheckoutData
{
    private
        $name,
        $surname,
        $patronymic,
        $email,
        $telephone,
        $city,
        $street,
        $house,
        $apartment;

    function __construct(array $data)
    {
        $this->name         = (string)$data['name'];
        $this->patronymic   = (string)$data['patronymic'];
        $this->surname      = (string)$data['surname'];
        $this->email        = (string)$data['email'];
        $this->telephone    = (string)$data['telephone'];
        $this->city         = (string)$data['city'];
        $this->street       = (string)$data['street'];
        $this->house        = (string)$data['house'];
        $this->apartment    = (string)$data['apartment'];
    }
    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getPatronymic()
    {
        return $this->patronymic;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function  getCity()
    {
        return $this->city;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getHouse()
    {
        return $this->house;
    }

    public function getApartment()
    {
        return $this->apartment;
    }


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name',        new NotBlank());
        $metadata->addPropertyConstraint('name',        new Assert\Length([
            'min' => 2,
            'max' => 50,
        ]));



        $metadata->addPropertyConstraint('surname',     new NotBlank());
        $metadata->addPropertyConstraint('surname',     new Assert\Length([
            'min' => 2,
            'max' => 50,
        ]));

        $metadata->addPropertyConstraint('patronymic',  new NotBlank());
        $metadata->addPropertyConstraint('patronymic',  new Assert\Length([
            'min' => 2,
            'max' => 50,
        ]));

        $metadata->addPropertyConstraint('email',       new NotBlank());
        $metadata->addPropertyConstraint('email',       new Assert\Email());
        $metadata->addPropertyConstraint('email',       new Assert\Length([
            'min' => 5,
            'max' => 320,
        ]));

        $metadata->addPropertyConstraint('telephone',   new NotBlank());
        $metadata->addPropertyConstraint('telephone', new Assert\Regex([
            'pattern' => '/^[78][0-9]{10}/',
        ]));

        $metadata->addPropertyConstraint('city',        new NotBlank());
        $metadata->addPropertyConstraint('street',      new NotBlank());
        $metadata->addPropertyConstraint('house',       new NotBlank());
        $metadata->addPropertyConstraint('apartment',   new NotBlank());
    }
}
