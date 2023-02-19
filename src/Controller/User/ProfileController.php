<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends AbstractController
{
    public function __construct(ManagerRegistry $doctrine) 
    {
        $this->doctrine = $doctrine;
    }

    
    #[Route('/profile', name: 'app_user_profile')]
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        return $this->render('user/profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'form' => $form,
            'user' => $user
        ]);
    }
}
