<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\QuestionMCQMultipleRepository;
use App\Repository\QuestionMCQSingleRepository;
use App\Repository\QuestionTextRepository;
use App\Repository\QuestionNumberRepository;
use App\Form\QuestionMCQMultipleType;
use App\Form\QuestionMCQSingleType;
use App\Form\QuestionNumberType;
use App\Form\QuestionTextType;


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

    #[Route('/questionsLibrary', name: 'questionsLibrary', methods: ['GET'])]
    public function questionsLibrary(QuestionMCQMultipleRepository $questionMCQMultipleRepository, QuestionMCQSingleRepository $questionMCQSingleRepository, QuestionTextRepository $questionTextRepository, QuestionNumberRepository $questionNumberRepository): Response
    {
        $formMultiple = $this->createForm(QuestionMCQMultipleType::class);
        $formSingle = $this->createForm(QuestionMCQSingleType::class);
        $formNumber = $this->createForm(QuestionNumberType::class);
        $formText = $this->createForm(QuestionTextType::class);

        return $this->render('pages/questionsLibrary.html.twig',[
            'question_mcq_multiples' => $questionMCQMultipleRepository->findAll(),
            'question_mcq_singles' => $questionMCQSingleRepository->findAll(),
            'question_texts' => $questionTextRepository->findAll(),
            'question_numbers' => $questionNumberRepository->findAll(),
            'formMultiple' => $formMultiple->createView(),
            'formSingle' => $formSingle->createView(),
            'formNumber' => $formNumber->createView(),
            'formText' => $formText->createView(),
        ]);
    }
}
