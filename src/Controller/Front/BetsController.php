<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BetsController extends AbstractController
{
    #[Route('/bets', name: 'app_front_bets')]
    public function index(): Response
    {
        return $this->render('front/bets/index.html.twig', [
            'controller_name' => 'Bets',
        ]);
    }
}
