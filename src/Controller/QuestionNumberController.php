<?php

namespace App\Controller;

use App\Entity\QuestionNumber;
use App\Form\QuestionNumberType;
use App\Repository\QuestionNumberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/question/number')]
class QuestionNumberController extends AbstractController
{
    #[Route('/', name: 'app_question_number_index', methods: ['GET'])]
    public function index(QuestionNumberRepository $questionNumberRepository): Response
    {
        return $this->render('question_number/index.html.twig', [
            'question_numbers' => $questionNumberRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_question_number_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuestionNumberRepository $questionNumberRepository): Response
    {
        $questionNumber = new QuestionNumber();
        $form = $this->createForm(QuestionNumberType::class, $questionNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionNumberRepository->save($questionNumber, true);

            return $this->redirectToRoute('app_question_number_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question_number/new.html.twig', [
            'question_number' => $questionNumber,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_question_number_show', methods: ['GET'])]
    public function show(QuestionNumber $questionNumber): Response
    {
        return $this->render('question_number/show.html.twig', [
            'question_number' => $questionNumber,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_question_number_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuestionNumber $questionNumber, QuestionNumberRepository $questionNumberRepository): Response
    {
        $form = $this->createForm(QuestionNumberType::class, $questionNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionNumberRepository->save($questionNumber, true);

            return $this->redirectToRoute('app_question_number_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question_number/edit.html.twig', [
            'question_number' => $questionNumber,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_question_number_delete', methods: ['POST'])]
    public function delete(Request $request, QuestionNumber $questionNumber, QuestionNumberRepository $questionNumberRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionNumber->getId(), $request->request->get('_token'))) {
            $questionNumberRepository->remove($questionNumber, true);
        }

        return $this->redirectToRoute('app_question_number_index', [], Response::HTTP_SEE_OTHER);
    }
}
