<?php

namespace App\Controller\Back;

use App\Entity\Matchs;
use App\Form\MatchsType;
use App\Repository\MatchsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/matchs')]
class MatchsController extends AbstractController
{
    #[Route('/', name: 'app_back_matchs_index', methods: ['GET'])]
    public function index(MatchsRepository $matchsRepository): Response
    {
        return $this->render('back/matchs/index.html.twig', [
            'matchs' => $matchsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_matchs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MatchsRepository $matchsRepository): Response
    {
        $match = new Matchs();
        $form = $this->createForm(MatchsType::class, $match);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matchsRepository->save($match, true);

            return $this->redirectToRoute('app_back_matchs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/matchs/new.html.twig', [
            'match' => $match,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_matchs_show', methods: ['GET'])]
    public function show(Matchs $match): Response
    {
        return $this->render('back/matchs/show.html.twig', [
            'match' => $match,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_matchs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Matchs $match, MatchsRepository $matchsRepository): Response
    {
        $form = $this->createForm(MatchsType::class, $match);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matchsRepository->save($match, true);

            return $this->redirectToRoute('app_back_matchs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/matchs/edit.html.twig', [
            'match' => $match,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_matchs_delete', methods: ['POST'])]
    public function delete(Request $request, Matchs $match, MatchsRepository $matchsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$match->getId(), $request->request->get('_token'))) {
            $matchsRepository->remove($match, true);
        }

        return $this->redirectToRoute('app_back_matchs_index', [], Response::HTTP_SEE_OTHER);
    }
}
