<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BetRepository;
use App\Entity\Bet;

#[Route('/bet', name: 'bet_')]
class BetController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(BetRepository $betRepository): Response
    {
        return $this->render('back/bet/index.html.twig', [
            'bets' => $betRepository->findBy([], ['date' => 'ASC']),
        ]);
    }
}
