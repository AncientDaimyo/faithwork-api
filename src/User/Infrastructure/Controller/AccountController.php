<?php

namespace App\User\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;
use App\User\Application\Boundary\UserInteractorInterface;

class AccountController extends AbstractController
{
    #[Route('/api/user/account', name: 'account', methods: ['GET'])]
    public function index()
    {

    }

    #[Route('/api/user/register', name: 'user_register', methods: ['POST'])]
    #[OA\RequestBody(
        description: "User data",
        required: true,
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(
                    property: "email",
                    type: "string",
                    format: "email",
                    example: "user@example.com"
                ),
                new OA\Property(
                    property: "name",
                    type: "string",
                    example: "John Doe"
                ),
                new OA\Property(
                    property: "password",
                    type: "string",
                    format: "password",
                    example: "mySecretPassword"
                ),
            ]
        )
    )]
    #[OA\Response(response: 201, description: "Success")]
    #[OA\Response(response: 400, description: "Error")]
    public function register(Request $request, UserInteractorInterface $userInteractor): Response
    {
        $content = json_decode($request->getContent(), true);
        $errors = $userInteractor->createAccount($content);

        if (!empty($errors)) {
            return new Response(json_encode($errors), 400);
        }

        return new Response(
            json_encode(['success' => true]),
            201
        );
    }
}