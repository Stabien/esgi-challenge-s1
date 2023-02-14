<?php

namespace App\Controller\Admin;

use App\Entity\TeamPlayer;
use App\Form\TeamPlayerType;
use App\Repository\TeamPlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/team/player')]
class TeamPlayerController extends AbstractController
{
    #[Route('/', name: 'app_admin_team_player_index', methods: ['GET'])]
    public function index(TeamPlayerRepository $teamPlayerRepository): Response
    {
        return $this->render('admin/team_player/index.html.twig', [
            'team_players' => $teamPlayerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_team_player_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TeamPlayerRepository $teamPlayerRepository): Response
    {
        $teamPlayer = new TeamPlayer();
        $form = $this->createForm(TeamPlayerType::class, $teamPlayer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $teamPlayerRepository->save($teamPlayer, true);

            return $this->redirectToRoute('app_admin_team_player_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/team_player/new.html.twig', [
            'team_player' => $teamPlayer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_team_player_show', methods: ['GET'])]
    public function show(TeamPlayer $teamPlayer): Response
    {
        return $this->render('admin/team_player/show.html.twig', [
            'team_player' => $teamPlayer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_team_player_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TeamPlayer $teamPlayer, TeamPlayerRepository $teamPlayerRepository): Response
    {
        $form = $this->createForm(TeamPlayerType::class, $teamPlayer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $teamPlayerRepository->save($teamPlayer, true);

            return $this->redirectToRoute('app_admin_team_player_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/team_player/edit.html.twig', [
            'team_player' => $teamPlayer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_team_player_delete', methods: ['POST'])]
    public function delete(Request $request, TeamPlayer $teamPlayer, TeamPlayerRepository $teamPlayerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$teamPlayer->getId(), $request->request->get('_token'))) {
            $teamPlayerRepository->remove($teamPlayer, true);
        }

        return $this->redirectToRoute('app_admin_team_player_index', [], Response::HTTP_SEE_OTHER);
    }
}
