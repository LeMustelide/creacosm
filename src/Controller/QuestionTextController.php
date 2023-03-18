<?php

namespace App\Controller;

use App\Entity\QuestionText;
use App\Form\QuestionTextType;
use App\Repository\QuestionTextRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/question/text')]
class QuestionTextController extends AbstractController
{
    #[Route('/', name: 'app_question_text_index', methods: ['GET'])]
    public function index(QuestionTextRepository $questionTextRepository): Response
    {
        return $this->render('question_text/index.html.twig', [
            'question_texts' => $questionTextRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_question_text_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuestionTextRepository $questionTextRepository): Response
    {
        $questionText = new QuestionText();
        $form = $this->createForm(QuestionTextType::class, $questionText);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionTextRepository->save($questionText, true);

            return $this->redirectToRoute('app_question_text_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question_text/new.html.twig', [
            'question_text' => $questionText,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_question_text_show', methods: ['GET'])]
    public function show(QuestionText $questionText): Response
    {
        return $this->render('question_text/show.html.twig', [
            'question_text' => $questionText,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_question_text_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuestionText $questionText, QuestionTextRepository $questionTextRepository): Response
    {
        $form = $this->createForm(QuestionTextType::class, $questionText);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionTextRepository->save($questionText, true);

            return $this->redirectToRoute('app_question_text_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question_text/edit.html.twig', [
            'question_text' => $questionText,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_question_text_delete', methods: ['POST'])]
    public function delete(Request $request, QuestionText $questionText, QuestionTextRepository $questionTextRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionText->getId(), $request->request->get('_token'))) {
            $questionTextRepository->remove($questionText, true);
        }

        return $this->redirectToRoute('app_question_text_index', [], Response::HTTP_SEE_OTHER);
    }
}
