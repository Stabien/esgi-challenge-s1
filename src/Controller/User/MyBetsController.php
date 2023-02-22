<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class MyBetsController extends AbstractController
{
    public function __construct(ManagerRegistry $doctrine) 
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/mybets', name: 'app_user_my_bets')]
    public function index(): Response
    {
        $bets = $this->getUser()->getBets();

        return $this->render('user/my_bets/index.html.twig', [
            'controller_name' => 'MyBetsController',
            'bets' => $bets
        ]);
    }
}
