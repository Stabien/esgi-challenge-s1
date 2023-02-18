<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Matchs;
use App\Entity\Bet;
use App\Form\BetType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\BetRepository;

class MatchsController extends AbstractController
{
    public function __construct(ManagerRegistry $doctrine) 
    {
        $this->doctrine = $doctrine;
    }
    
    #[Route('/matchs', name: 'app_user_matchs')]
    public function index(Request $request, BetRepository $betRepository): Response
    {
        $matchs = $this->doctrine->getRepository(Matchs::class)->findAll();

        $bet = new Bet();
        $user = $this->getUser();

        $form = $this->createForm(BetType::class, $bet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($user === null) {
                return $this->redirectToRoute('app_login');
            }

            $bet->setUser($user);
            $bet->setStatus(0);
            $bet->setEarnings(0);

            // Verify if match has not began
            if ($bet->getMatch()->getTeamWinner() === null) {
                $betRepository->save($bet, true);
            }

            return $this->redirectToRoute('app_user_matchs');
        }


        return $this->renderForm('user/matchs/index.html.twig', [
            'controller_name' => 'MatchsController',
            'matchs' => $matchs,
            'form' => $form
        ]);
    }
}
