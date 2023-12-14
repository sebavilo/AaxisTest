<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class GestionarUsuariosController extends AbstractController
{
    private $em;
    /**
     * @param em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/gestionar-usuarios', name: 'app_gestionar_usuarios', methods:['POST'])]
    public function gestionarUsuarios(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = new User();
        $plainTextPassword = $data['password'];

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plainTextPassword
            );
            $user->setEmail($data['email']);
            $user->setPassword($hashedPassword);

            $this->em->persist($user);
            $this->em->flush();

        return new JsonResponse('Usuario agregado exitosamente!');
    }
}
