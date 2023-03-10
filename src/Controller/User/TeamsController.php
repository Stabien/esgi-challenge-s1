<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Team;

class TeamsController extends AbstractController
{
    public function __construct(ManagerRegistry $doctrine) 
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/teams', name: 'app_teams')]
    public function index(): Response
    {
        $teams = $this->doctrine->getRepository(Team::class)->findAll();

        return $this->render('user/teams/index.html.twig', [
            'controller_name' => 'TeamsController',
            'teams' => $teams
        ]);
    }
}
