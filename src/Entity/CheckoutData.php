<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class CheckoutData
{
    public
        $name,
        $surname,
        $patronomic,
        $email,
        $telephone,
        $city,
        $street,
        $house,
        $apartment;
    function __construct(array $data)
    {
        $this->name         = $data['name'];
        $this->patronomic   = $data['patronomic'];
        $this->surname      = $data['surname'];
        $this->email        = $data['email'];
        $this->telephone    = $data['telephone'];
        $this->city         = $data['city'];
        $this->street       = $data['street'];
        $this->house        = $data['house'];
        $this->apartment    = $data['apartment'];
    }
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name',        new NotBlank());
        $metadata->addPropertyConstraint('surname',     new NotBlank());
        $metadata->addPropertyConstraint('patronomic',  new NotBlank());
        $metadata->addPropertyConstraint('email',       new NotBlank());
        $metadata->addPropertyConstraint('telephone',   new NotBlank());
        $metadata->addPropertyConstraint('city',        new NotBlank());
        $metadata->addPropertyConstraint('street',      new NotBlank());
        $metadata->addPropertyConstraint('house',       new NotBlank());
        $metadata->addPropertyConstraint('apartment',   new NotBlank());
    }
}