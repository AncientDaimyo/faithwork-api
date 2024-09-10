<?php

namespace App\User\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use App\User\Application\Boundary\AuthorizationInteractorInterface;

class AuthorizationController extends AbstractController
{
    #[Route('/account/log-in', name: 'account_log_in', methods: ['POST'])]
    public function logIn(Request $request, AuthorizationInteractorInterface $authInteractor)
    {
        $authInteractor->logIn(json_decode($request->getContent(), true));
        return new Response();
    }

    #[Route('/account/log-out', name: 'account_log_out', methods: ['POST'])]
    public function logOut()
    {

    }
}