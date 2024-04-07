<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout', methods: ['POST'])]
    public function checkout(Request $request, ValidatorInterface $validator): Response
    {
        $data       = $request->toArray();
        $integrity  = $this->checkDataIntegrity($data);
        if ($integrity) {
            $co_data = new CheckoutData($data);


            $errors = $this->co_data_validate($co_data, $validator);
            if(!$errors)
            {
                $response = new Response(
                    'Content',
                    Response::HTTP_OK,
                );
                $response->headers->set('Content-Type', 'application/json');
                $response->setContent(json_encode(array('status' => 'OK')));
            }
            else
            {
                $response = new Response(
                    'Content',
                    Response::HTTP_I_AM_A_TEAPOT,
                );
                $response->headers->set('Content-Type', 'application/json');
                $response->setContent(json_encode(array('errors' => $errors, 'status' => 'validation failed'))); 
            }

        } else 
        {
            $response = new Response(
                'Content',
                Response::HTTP_I_AM_A_TEAPOT,
                ['content-type' => 'application/json']           
            );
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent(json_encode(array('status' => 'data integrity has been violated')));
        }

        return $response;
    }

    private function checkDataIntegrity(array $data): bool
    {
        if (
            isset($data['name'])
            && isset($data['surname'])
            && isset($data['patronomic'])
            && isset($data['email'])
            && isset($data['telephone'])
            && isset($data['city'])
            && isset($data['street'])
            && isset($data['house'])
            && isset($data['apartment'])
        ) {
            return true;
        } else {
            return false;
        }
    }
    private function co_data_validate($co_data, ValidatorInterface $validator) {
        $errors = $validator->validate($co_data);
        if (count($errors) > 0) {
    
            return $errors;
        }
        else {
            return false;
        }
    }
}


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
