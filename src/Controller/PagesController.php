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

    #[Route('/new_sondage', name: 'new_sondage')]
    public function newSondage(): Response
    {
        return $this->render('pages/creation_sondage.html.twig');
    }

    #[Route('/clients', name: 'clients_list')]
    public function listeClients(): Response
    {
        return $this->render('pages/clientsList.html.twig');
    }
    
    #[Route('/questionsLibrary', name: 'questionsLibrary')]
    public function questionsLibrary(): Response
    {
        return $this->render('pages/questionsLibrary.html.twig');
    }

    #[Route('/parameters', name: 'parameters')]
    public function parameters(): Response
    {
        return $this->render('pages/parameters.html.twig');
    }
}
