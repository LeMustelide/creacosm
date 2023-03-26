<?php

namespace App\Controller;

use App\Entity\Poll;
use App\Entity\History;
use App\Entity\TextAnswer;
use App\Form\PollType;
use App\Repository\PollRepository;
use App\Repository\HistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\QuestionMCQMultipleType;
use App\Form\QuestionMCQSingleType;
use App\Form\QuestionNumberType;
use App\Form\QuestionTextType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Uid\Uuid;

#[Route('/poll')]
class PollController extends AbstractController
{
    #[Route('/', name: 'app_poll_index', methods: ['GET'])]
    public function index(PollRepository $pollRepository): Response
    {
        return $this->render('poll/index.html.twig', [
            'polls' => $pollRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_poll_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PollRepository $pollRepository): Response
    {
        $formMultiple = $this->createForm(QuestionMCQMultipleType::class);
        $formSingle = $this->createForm(QuestionMCQSingleType::class);
        $formNumber = $this->createForm(QuestionNumberType::class);
        $formText = $this->createForm(QuestionTextType::class);

        $poll = new Poll();
        $form = $this->createForm(PollType::class, $poll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $poll->setCreationDate(new \DateTime());
            $pollRepository->save($poll, true);

            return $this->redirectToRoute('app_poll_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('poll/new.html.twig', [
            'formMultiple' => $formMultiple->createView(),
            'formSingle' => $formSingle->createView(),
            'formNumber' => $formNumber->createView(),
            'formText' => $formText->createView(),
            'poll' => $poll,
            'form' => $form,
        ]);
    }

    #[Route('/end', name: 'app_poll_end', methods: ['GET'])]
    public function end(): Response
    {
        return $this->render('pages/endPoll.html.twig');
    }

    #[Route('/{id}', name: 'app_poll_show', methods: ['GET'])]
    public function show(Poll $poll): Response
    {
        return $this->render('poll/show.html.twig', [
            'poll' => $poll,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_poll_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Poll $poll, PollRepository $pollRepository): Response
    {

        $formMultiple = $this->createForm(QuestionMCQMultipleType::class);
        $formSingle = $this->createForm(QuestionMCQSingleType::class);
        $formNumber = $this->createForm(QuestionNumberType::class);
        $formText = $this->createForm(QuestionTextType::class);

        $form = $this->createForm(PollType::class, $poll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pollRepository->save($poll, true);

            return $this->redirectToRoute('app_poll_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('poll/edit.html.twig', [
            'poll' => $poll,
            'form' => $form,
            'formMultiple' => $formMultiple->createView(),
            'formSingle' => $formSingle->createView(),
            'formNumber' => $formNumber->createView(),
            'formText' => $formText->createView()
        ]);
    }

    #[Route('/{id}', name: 'app_poll_delete', methods: ['POST'])]
    public function delete(Request $request, Poll $poll, PollRepository $pollRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $poll->getId(), $request->request->get('_token'))) {
            $pollRepository->remove($poll, true);
        }

        return $this->redirectToRoute('app_poll_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/respond/{questionId}/{token}', name: 'app_poll_respond', methods: ['GET', 'POST'])]
    public function respond(Request $request, Poll $poll, PollRepository $pollRepository, HistoryRepository $historyRepository, $questionId, $token): Response
    {
        if (!$poll->isPublic()) {
            $this->addFlash('error', 'This poll is not public.');
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }
        if ($poll->getIsClosed()) {
            $this->addFlash('error', 'This poll is closed.');
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        $decodedToken = base64_decode($token);
        $decodedUuid = str_replace('creacosm', '', $decodedToken);
        if ($decodedToken == null) {
            $this->addFlash('error', 'Invalid token.');
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        } elseif (!str_contains($decodedToken, 'creacosm') or !Uuid::isValid($decodedUuid)) {
            $this->addFlash('error', 'Invalid token.');
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }
        

        $question = null;
        $questions = $poll->getAllQuestions();
        $advancement = 0;

        if ($questionId < count($questions)){
            $question = $questions[$questionId];
            $advancement = $questionId;
        }


        if ($question == null) {
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        if ($request->isMethod('POST')) {

            $history = new History();
            $history->setPoll($poll);
            $question = $questions[$questionId-1];

            if (get_class($question) == "App\Entity\QuestionMCQMultiple") {
                $checkedAnswerIds = [];
                foreach ($request->request->all() as $key => $value) {
                    if (str_starts_with($key, 'checkbox')) {
                        $answerId = substr($key, 8); // Enlève "checkbox" du nom pour récupérer l'ID
                        $checkedAnswerIds[] = $answerId;
                    }
                }
                // Récupère toutes les réponses de la question
                $allAnswers = $question->getAnswers();

                // Filtrer uniquement les réponses sélectionnées
                $selectedAnswers = [];
                foreach ($allAnswers as $answer) {
                    if (in_array($answer->getId(), $checkedAnswerIds)) {
                        $selectedAnswers[] = $answer;
                    }
                }

                // Créer une ArrayCollection avec les réponses sélectionnées
                $selectedAnswersCollection = new ArrayCollection($selectedAnswers);

                // Utiliser $selectedAnswersCollection pour appeler la méthode setAnswer
                $history->setAnswer($selectedAnswersCollection);
                $history->setDate(new \DateTime());
                $history->setUuid($decodedUuid);
                //Uuid::v4()
                $historyRepository->save($history, true);
            } elseif (get_class($question) == "App\Entity\QuestionMCQSingle") {
                $answerId = $request->request->get('radio');
                $answer = $question->getAnswer($answerId);
                $history->setAnswer($answer);
                $history->setDate(new \DateTime());
                $history->setUuid($decodedUuid);
                $historyRepository->save($history, true);
            } elseif (get_class($question) == "App\Entity\QuestionNumber") {
                $answer = $request->request->get('number');
                $history->setNumberAnswer($answer);
                $history->setDate(new \DateTime());
                $history->setUuid($decodedUuid);
                $historyRepository->save($history, true);
            } elseif (get_class($question) == "App\Entity\QuestionText") {
                $textAnswer = new TextAnswer();
                $textAnswer->setContent($request->request->get('answer'));
                $textAnswer->setQuestion($question);
                $history->setTextAnswer($textAnswer);
                $history->setDate(new \DateTime());
                $history->setUuid($decodedUuid);
                $historyRepository->save($history, true);
            }

            if ($advancement >= count($questions)) {
                //return new Response('Aucune condition correspondante à la class');
                return $this->redirectToRoute('app_poll_end', [], Response::HTTP_SEE_OTHER);
            } else {
                return $this->redirectToRoute('app_poll_respond', ['id' => $poll->getId(), 'questionId' => $questionId, 'token' => $token], Response::HTTP_SEE_OTHER);
            }
        }

        if (get_class($question) == "App\Entity\QuestionMCQMultiple") {
            return $this->render('pages/question_multiple_choice.html.twig', [
                'question' => $question,
                'poll' => $poll,
                'percentage' => ($advancement) * 100 / count($questions),
                'questionId' => $questionId,
                'length' => count($questions),
                'token' => $token,
            ]);
        } elseif (get_class($question) == "App\Entity\QuestionMCQSingle") {
            return $this->render('pages/question_single_choice.html.twig', [
                'question' => $question,
                'poll' => $poll,
                'percentage' => ($advancement) * 100 / count($questions),
                'questionId' => $questionId,
                'length' => count($questions),
                'token' => $token,
            ]);
        } elseif (get_class($question) == "App\Entity\QuestionNumber") {
            return $this->render('pages/question_number.html.twig', [
                'question' => $question,
                'poll' => $poll,
                'percentage' => ($advancement) * 100 / count($questions),
                'questionId' => $questionId,
                'length' => count($questions),
                'token' => $token,
            ]);
        } elseif (get_class($question) == "App\Entity\QuestionText") {
            return $this->render('pages/question_text.html.twig', [
                'question' => $question,
                'poll' => $poll,
                'percentage' => ($advancement) * 100 / count($questions),
                'questionId' => $questionId,
                'length' => count($questions),
                'token' => $token,
            ]);
        }
        return new Response('Aucune condition correspondante à la class' . get_class($question));
    }
}
