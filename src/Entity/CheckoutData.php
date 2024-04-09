<?php

namespace App\Entity;

use phpDocumentor\Reflection\Types\This;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
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
    public array $products;
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
        $this->products     = $data['products'];
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

        $metadata->addPropertyConstraint('patronomic',  new NotBlank());
        $metadata->addPropertyConstraint('patronomic',  new Assert\Length([
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
