<?php

namespace App\Controller;

use App\Dto\RegisterDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


#[Route('/api', name: 'api_')]
class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'register')]
    public function index(EntityManagerInterface $em, Request $request, ValidatorInterface $validator
        , SerializerInterface $serializer, UserPasswordHasherInterface $passwordHasher): Response
    {

        $registerDto = $serializer->deserialize($request->getContent(), RegisterDto::class, 'json');
        $errors = $validator->validate($registerDto);

        if (count($errors) > 0) {
            return $this->json($errors, 400);
        } else {

            $checkEmail = $em->getRepository(User::class)->findOneBy(['email' => $registerDto->email]);
            if ($checkEmail) {
                return $this->json(['error' => 'Email already exists', 'status_code' => 400], 400);
            }

            $checkUsername = $em->getRepository(User::class)->findOneBy(['username' => $registerDto->username]);
            if ($checkUsername) {
                return $this->json(['error' => 'Username already exists', 'status_code' => 400], 400);
            }

            $user = new User();
            $user->setEmail($registerDto->email);
            $user->setUsername($registerDto->username);
            $user->setPassword($passwordHasher->hashPassword($user, $registerDto->password));
            $user->setRoles(['ROLE_USER']);
            $em->persist($user);
            $em->flush();

            return $this->json(['message' => 'Registered Successfully']);
        }
    }
}