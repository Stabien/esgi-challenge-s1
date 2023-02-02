<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamsController extends AbstractController
{
    #[Route('/teams', name: 'app_teams')]
    public function index(): Response
    {
        return $this->render('teams/index.html.twig', [
            'controller_name' => 'TeamsController',
        ]);
    }
}
