<?php

namespace App\Controller;

use App\Entity\QuestionMCQSingle;
use App\Form\QuestionMCQSingleType;
use App\Repository\QuestionMCQSingleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/question/mcq/single')]
class QuestionMCQSingleController extends AbstractController
{
    #[Route('/', name: 'app_question_mcq_single_index', methods: ['GET'])]
    public function index(QuestionMCQSingleRepository $questionMCQSingleRepository): Response
    {
        return $this->render('question_mcq_single/index.html.twig', [
            'question_mcq_singles' => $questionMCQSingleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_question_mcq_single_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuestionMCQSingleRepository $questionMCQSingleRepository): Response
    {
        $questionMCQSingle = new QuestionMCQSingle();
        $form = $this->createForm(QuestionMCQSingleType::class, $questionMCQSingle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionMCQSingleRepository->save($questionMCQSingle, true);

            return $this->redirectToRoute('questionsLibrary', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question_mcq_single/new.html.twig', [
            'question_mcq_single' => $questionMCQSingle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_question_mcq_single_show', methods: ['GET'])]
    public function show(QuestionMCQSingle $questionMCQSingle): Response
    {
        return $this->render('question_mcq_single/show.html.twig', [
            'question_mcq_single' => $questionMCQSingle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_question_mcq_single_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuestionMCQSingle $questionMCQSingle, QuestionMCQSingleRepository $questionMCQSingleRepository): Response
    {
        $form = $this->createForm(QuestionMCQSingleType::class, $questionMCQSingle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionMCQSingleRepository->save($questionMCQSingle, true);

            return $this->redirectToRoute('questionsLibrary', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question_mcq_single/edit.html.twig', [
            'question_mcq_single' => $questionMCQSingle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_question_mcq_single_delete', methods: ['POST'])]
    public function delete(Request $request, QuestionMCQSingle $questionMCQSingle, QuestionMCQSingleRepository $questionMCQSingleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionMCQSingle->getId(), $request->request->get('_token'))) {
            $questionMCQSingleRepository->remove($questionMCQSingle, true);
        }

        return $this->redirectToRoute('questionsLibrary', [], Response::HTTP_SEE_OTHER);
    }
}
