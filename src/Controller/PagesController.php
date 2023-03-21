<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{

    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('pages/dashboard.html.twig');
    }

    #[Route('/', name: '')]
    public function acceuil(): Response
    {
        return $this->render('pages/accueil.html.twig');
    }

    #[Route('/clients', name: 'clients_list')]
    public function listeClients(): Response
    {
        return $this->render('pages/clientsList.html.twig');
    }

    #[Route('/statistiques', name: 'statistiques')]
    public function statistiques(): Response
    {
        return $this->render('pages/statistiques.html.twig');
    }
}
