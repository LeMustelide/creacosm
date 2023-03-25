<?php

namespace App\Controller;

use App\Entity\Statistic;
use App\Form\StatisticType;
use App\Repository\StatisticRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statistic')]
class StatisticController extends AbstractController
{
    #[Route('/', name: 'app_statistic_index', methods: ['GET'])]
    public function index(StatisticRepository $statisticRepository): Response
    {
        return $this->render('statistic/index.html.twig', [
            'statistics' => $statisticRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statistic_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StatisticRepository $statisticRepository): Response
    {
        $statistic = new Statistic();
        $form = $this->createForm(StatisticType::class, $statistic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statisticRepository->save($statistic, true);

            return $this->redirectToRoute('app_statistic_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statistic/new.html.twig', [
            'statistic' => $statistic,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statistic_show', methods: ['GET'])]
    public function show(Statistic $statistic): Response
    {
        return $this->render('statistic/show.html.twig', [
            'statistic' => $statistic,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statistic_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Statistic $statistic, StatisticRepository $statisticRepository): Response
    {
        $form = $this->createForm(StatisticType::class, $statistic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statisticRepository->save($statistic, true);

            return $this->redirectToRoute('app_statistic_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statistic/edit.html.twig', [
            'statistic' => $statistic,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statistic_delete', methods: ['POST'])]
    public function delete(Request $request, Statistic $statistic, StatisticRepository $statisticRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statistic->getId(), $request->request->get('_token'))) {
            $statisticRepository->remove($statistic, true);
        }

        return $this->redirectToRoute('app_statistic_index', [], Response::HTTP_SEE_OTHER);
    }
}
