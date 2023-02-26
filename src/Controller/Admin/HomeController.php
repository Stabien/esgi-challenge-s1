<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_home')]
    public function index(): Response
    {
        return $this->render('admin/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
