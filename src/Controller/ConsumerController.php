<?php

namespace App\Controller;

use App\Entity\Consumer;
use App\Form\ConsumerType;
use App\Repository\ConsumerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/consumer')]
class ConsumerController extends AbstractController
{
    #[Route('/', name: 'app_consumer_index', methods: ['GET'])]
    public function index(ConsumerRepository $consumerRepository): Response
    {
        $form = $this->createForm(ConsumerType::class);
        return $this->render('consumer/index.html.twig', [
            'consumers' => $consumerRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/', name: 'app_consumer_new', methods: ['POST'])]
    public function new(Request $request, ConsumerRepository $consumerRepository): Response
    {
        $consumer = new Consumer();
        $form = $this->createForm(ConsumerType::class, $consumer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $consumer->setDate(new \DateTime());
            $consumerRepository->save($consumer, true);

            return $this->redirectToRoute('app_consumer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('consumer/new.html.twig', [
            'consumer' => $consumer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_consumer_show', methods: ['GET'])]
    public function show(Consumer $consumer): Response
    {
        return $this->render('consumer/show.html.twig', [
            'consumer' => $consumer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_consumer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Consumer $consumer, ConsumerRepository $consumerRepository): Response
    {
        $form = $this->createForm(ConsumerType::class, $consumer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $consumerRepository->save($consumer, true);

            return $this->redirectToRoute('app_consumer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('consumer/edit.html.twig', [
            'consumer' => $consumer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_consumer_delete', methods: ['POST'])]
    public function delete(Request $request, Consumer $consumer, ConsumerRepository $consumerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$consumer->getId(), $request->request->get('_token'))) {
            $consumerRepository->remove($consumer, true);
        }

        return $this->redirectToRoute('app_consumer_index', [], Response::HTTP_SEE_OTHER);
    }
}
