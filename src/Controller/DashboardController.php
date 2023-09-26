<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/api', name: 'api_')]
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to the dashboard'
        ]);
    }

    #[Route('/dashboard/me', name: 'dashboard_me')]
    public function me(EntityManagerInterface $em): Response
    {

        $user = $em->getRepository(User::class)->findOneBy(['email' => $this->getUser()->getUserIdentifier()]);
        return $this->json($user, 200, [], ['groups' => 'user']);
    }

}