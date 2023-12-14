<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\SecurityHelper;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class SecurityController extends AbstractController
{
    // public function getToken(UserInterface $user, JWTTokenManagerInterface $JWTManager): JsonResponse
    // {
    //     $token = $JWTManager->create($user);

    //     return new JsonResponse(['token' => $token]);
    // }

    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(Request $request, Security $security): JsonResponse
    {
        $user = $security->getUser();

        // Generar token
        $token = $this->generateToken($user);

        // Retornar token
        return new JsonResponse(['token' => $token]);
    }

    private function generateToken($user)
    {
        $token = $this->get('lexik_jwt_authentication.jwt_manager')->create($user);

        return $token;
    }
}
