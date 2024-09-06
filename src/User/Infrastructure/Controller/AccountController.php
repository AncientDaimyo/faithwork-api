<?php

namespace App\User\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'account', methods: ['GET'])]
    #[OA\Response(
        response: 200,
    )]
    public function index()
    {

    }


    #[Route('/account/edit', name: 'account_edit', methods: ['PUT'])]
    #[OA\Response(
        response: 200,
    )]
    public function edit(Request $request): Response
    {
        $data = $request->toArray();
    }

    #[Route('/account/change-password', name: 'account_change_password', methods: ['PUT'])]
    public function changePassword()
    {

    }

    #[Route('/account/delete', name: 'account_delete', methods: ['DELETE'])]
    public function delete()
    {

    }

    #[Route('/account/register', name: 'account_register', methods: ['POST'])]
    public function register()
    {

    }
}