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
    #[Route('/question_text', name: 'question_text')]
    public function question_text(): Response
    {
        return $this->render('pages/question_text.html.twig');
    }

    #[Route('/question_number', name: 'question_number')]
    public function question_number(): Response
    {
        return $this->render('pages/question_number.html.twig');
    }

    #[Route('/question_multiple_choice', name: 'question_multiple_choice')]
    public function question_multiple_choice(): Response
    {
        return $this->render('pages/question_multiple_choice.html.twig');
    }

    #[Route('/question_one_choice', name: 'question_one_choice')]
    public function question_one_choice(): Response
    {
        return $this->render('pages/question_one_choice.html.twig');
    }
}
