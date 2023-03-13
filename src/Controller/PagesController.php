<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    #[Route('/app', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('pages/dashboard.html.twig');
    }

    #[Route('/', name: 'home')]
    public function acceuil(): Response
    {
        return $this->render('pages/acceuil.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }
}
