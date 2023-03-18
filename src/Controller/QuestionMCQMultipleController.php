<?php

namespace App\Controller;

use App\Entity\QuestionMCQMultiple;
use App\Form\QuestionMCQMultipleType;
use App\Repository\QuestionMCQMultipleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/question/mcq/multiple')]
class QuestionMCQMultipleController extends AbstractController
{
    #[Route('/', name: 'app_question_mcq_multiple_index', methods: ['GET'])]
    public function index(QuestionMCQMultipleRepository $questionMCQMultipleRepository): Response
    {
        return $this->render('question_mcq_multiple/index.html.twig', [
            'question_mcq_multiples' => $questionMCQMultipleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_question_mcq_multiple_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuestionMCQMultipleRepository $questionMCQMultipleRepository): Response
    {
        $questionMCQMultiple = new QuestionMCQMultiple();
        $form = $this->createForm(QuestionMCQMultipleType::class, $questionMCQMultiple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionMCQMultipleRepository->save($questionMCQMultiple, true);

            return $this->redirectToRoute('app_question_mcq_multiple_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question_mcq_multiple/new.html.twig', [
            'question_mcq_multiple' => $questionMCQMultiple,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_question_mcq_multiple_show', methods: ['GET'])]
    public function show(QuestionMCQMultiple $questionMCQMultiple): Response
    {
        return $this->render('question_mcq_multiple/show.html.twig', [
            'question_mcq_multiple' => $questionMCQMultiple,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_question_mcq_multiple_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuestionMCQMultiple $questionMCQMultiple, QuestionMCQMultipleRepository $questionMCQMultipleRepository): Response
    {
        $form = $this->createForm(QuestionMCQMultipleType::class, $questionMCQMultiple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionMCQMultipleRepository->save($questionMCQMultiple, true);

            return $this->redirectToRoute('app_question_mcq_multiple_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question_mcq_multiple/edit.html.twig', [
            'question_mcq_multiple' => $questionMCQMultiple,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_question_mcq_multiple_delete', methods: ['POST'])]
    public function delete(Request $request, QuestionMCQMultiple $questionMCQMultiple, QuestionMCQMultipleRepository $questionMCQMultipleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionMCQMultiple->getId(), $request->request->get('_token'))) {
            $questionMCQMultipleRepository->remove($questionMCQMultiple, true);
        }

        return $this->redirectToRoute('app_question_mcq_multiple_index', [], Response::HTTP_SEE_OTHER);
    }
}
