<?php

namespace App\Controller\Admin;

use App\Entity\Bet;
use App\Form\BetType;
use App\Repository\BetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/bet')]
class BetController extends AbstractController
{
    #[Route('/', name: 'app_admin_bet_index', methods: ['GET'])]
    public function index(BetRepository $betRepository): Response
    {
        return $this->render('admin/bet/index.html.twig', [
            'bets' => $betRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_bet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BetRepository $betRepository): Response
    {
        $bet = new Bet();
        $form = $this->createForm(BetType::class, $bet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $betRepository->save($bet, true);

            return $this->redirectToRoute('app_admin_bet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/bet/new.html.twig', [
            'bet' => $bet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_bet_show', methods: ['GET'])]
    public function show(Bet $bet): Response
    {
        return $this->render('admin/bet/show.html.twig', [
            'bet' => $bet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_bet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bet $bet, BetRepository $betRepository): Response
    {
        $form = $this->createForm(BetType::class, $bet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $betRepository->save($bet, true);

            return $this->redirectToRoute('app_admin_bet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/bet/edit.html.twig', [
            'bet' => $bet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_bet_delete', methods: ['POST'])]
    public function delete(Request $request, Bet $bet, BetRepository $betRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bet->getId(), $request->request->get('_token'))) {
            $betRepository->remove($bet, true);
        }

        return $this->redirectToRoute('app_admin_bet_index', [], Response::HTTP_SEE_OTHER);
    }
}
