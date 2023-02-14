<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Matchs;

class MatchsController extends AbstractController
{
    public function __construct(ManagerRegistry $doctrine) 
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/matchs', name: 'app_user_matchs')]
    public function index(): Response
    {
        $matchs = $this->doctrine->getRepository(Matchs::class)->findAll();

        return $this->render('user/matchs/index.html.twig', [
            'controller_name' => 'MatchsController',
            'matchs' => $matchs
        ]);
    }
}
