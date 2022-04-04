<?php

namespace App\Controller\devis;

use app\Entity\Contact;
use DateTimeImmutable;
use App\Entity\Estimates;
use App\Form\EstimatesType;
use App\Repository\EstimatesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class EstimatesController extends AbstractController
{
    #[Route('/les-devis', name: 'estimates_index', methods: ['GET'])]
    #[IsGranted("ROLE_ADMIN")]
    public function index(EstimatesRepository $estimatesRepository): Response
    {
        return $this->render('estimates/index.html.twig', [
            'estimates' => $estimatesRepository->findAll(),
        ]);
    }

    #[Route('/devis', name: 'estimates_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $estimate = new Estimates();
        $form = $this->createForm(EstimatesType::class, $estimate);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $estimate->setCreatedAt(new DateTimeImmutable());
            $entityManager->persist($estimate);
            $entityManager->flush();

            $this->addFlash('success', 'Votre demande de devis a bien été envoyer');
            return $this->redirectToRoute('estimates_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('estimates/new.html.twig', [
            'estimate' => $estimate,
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'estimates_show', methods: ['GET'])]
    // public function show(Estimates $estimate): Response
    // {
    //     return $this->render('estimates/show.html.twig', [
    //         'estimate' => $estimate,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'estimates_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Estimates $estimate, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(EstimatesType::class, $estimate);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('estimates_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('estimates/edit.html.twig', [
    //         'estimate' => $estimate,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('delete-devis/{id}', name: 'estimates_delete', methods: ['POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(Request $request, Estimates $estimate, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $estimate->getId(), $request->request->get('_token'))) {
            $entityManager->remove($estimate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('estimates_index', [], Response::HTTP_SEE_OTHER);
    }
}
