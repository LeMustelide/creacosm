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

    #[Route('/home', name: 'home')]
    public function acceuil(): Response
    {
        return $this->render('pages/accueil.html.twig');
    }

    #[Route('/liste_clients', name: 'liste_clients')]
    public function listeClients(): Response
    {
        return $this->render('pages/liste_clients.html.twig');
    }
}
