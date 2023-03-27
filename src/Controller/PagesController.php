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
use App\Repository\ConsumerRepository;
use App\Repository\PollRepository;
use App\Repository\HistoryRepository;


class PagesController extends AbstractController
{

    #[Route('/dashboard', name: 'dashboard')]
    public function index(PollRepository $pollRepository, HistoryRepository $historyRepository, ConsumerRepository $consumerRepository): Response
    {
        $responsesCountByDate = $historyRepository->findResponsesCountByMonth();
        $consumersCountByDate = $consumerRepository->findConsumersCountByMonth();

        $responsesCountByMonth = [];
        foreach ($responsesCountByDate as $response) {
            $month = $response['date']->format('Y-m');
            if (!isset($responsesCountByMonth[$month])) {
                $responsesCountByMonth[$month] = 0;
            }
            $responsesCountByMonth[$month] += $response['count'];
        }
        ksort($responsesCountByMonth);

        $consumersCountByMonth = [];
        foreach ($consumersCountByDate as $consumer) {
            $month = $consumer['date']->format('Y-m');
            if (!isset($consumersCountByMonth[$month])) {
                $consumersCountByMonth[$month] = 0;
            }
            $consumersCountByMonth[$month] += $consumer['count'];
        }
        ksort($consumersCountByMonth);
        return $this->render('pages/dashboard.html.twig', [
            'nbPoll' => count($pollRepository->findAll()),
            'polls' => $pollRepository->findRecentPolls(),
            'responsesCountByMonth' => $responsesCountByMonth,
            'consumersCountByMonth' => $consumersCountByMonth,
            'nbConsumer' => count($consumerRepository->findAll()),
        ]);
    }

    #[Route('/', name: 'home')]
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

        return $this->render('pages/questionsLibrary.html.twig', [
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

    #[Route('/statistics', name: 'statistics')]
    public function statistiques(): Response
    {
        return $this->render('pages/statistics.html.twig');
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

    #[Route('/question_single_choice', name: 'question_single_choice')]
    public function question_single_choice(): Response
    {
        return $this->render('pages/question_single_choice.html.twig');
    }

    #[Route('/parameters', name: 'parameters')]
    public function parameters(): Response
    {
        return $this->render('pages/parameters.html.twig');
    }
}
