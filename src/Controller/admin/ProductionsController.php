<?php

namespace App\Controller\admin;

use App\Entity\Images;
use DateTimeImmutable;
use App\Entity\Productions;
use App\Form\ProductionsType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProductionsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/productions')]
class ProductionsController extends AbstractController
{
    #[Route('/', name: 'productions_index', methods: ['GET'])]
    public function index(ProductionsRepository $productionsRepository): Response
    {
        $images = new Images();
        $images->getName();

        return $this->render('productions/index.html.twig', [
            'productions' => $productionsRepository->findAll(),
            'images' => $images,

        ]);
    }

    #[Route('/new', name: 'productions_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $production = new Productions();
        $form = $this->createForm(ProductionsType::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //recupere les images uploader
            $images = $form->get('images')->getData();

            //boucle sur les images

            foreach ($images as $image) {
                //generer un nouveau nom de fichier
                $files = md5(uniqid()) . '.' . $image->guessExtension();

                //copie des fichier dans dossier images
                $image->move(
                    $this->getParameter('images_directory'),
                    $files
                );
                if (isset($image)) {

                    //Creer enregistrement dans BDD
                    $img = new Images();
                    $img->setName($files);
                    $production->addImage($img);
                }
            }
            $production->setCreatedAt(new DateTimeImmutable());
            $entityManager->persist($production);
            $entityManager->flush();

            return $this->redirectToRoute('productions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('productions/new.html.twig', [
            'production' => $production,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'productions_show', methods: ['GET'])]

    public function show(Productions $production): Response
    {
        $images = new Images();
        $images->getName();
        return $this->render('productions/show.html.twig', [
            'production' => $production,
            'images' => $images,
        ]);
    }

    #[Route('/{id}/edit', name: 'productions_edit', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function edit(Request $request, Productions $production, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductionsType::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('images')->getData();

            //boucle sur les images

            foreach ($images as $image) {
                //generer un nouveau nom de fichier
                $files = md5(uniqid()) . '.' . $image->guessExtension();

                //copie des fichier dans dossier images
                $image->move(
                    $this->getParameter('images_directory'),
                    $files
                );

                //Creer enregistrement dans BDD
                $img = new Images();
                if (isset($img)) {
                    $img->setName($files);
                    $production->addImage($img);
                }
            }
            $production->setCreatedAt(new DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('productions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('productions/edit.html.twig', [
            'production' => $production,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'productions_delete', methods: ['POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(Request $request, Productions $production, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $production->getId(), $request->request->get('_token'))) {
            $entityManager->remove($production);
            $entityManager->flush();
        }

        return $this->redirectToRoute('productions_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/supprime/image/{id}', name: 'production_delete_image', methods: ['DELETE'])]
    #[IsGranted("ROLE_ADMIN")]
    public function deleteImage(Images $image, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        // Verifie si le token est valide
        if ($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])) {
            $name = $image->getName();
            unlink($this->getParameter('images_directory') . '/' . $name);
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($image);
            $manager->flush();

            //on repond en JSON
            return new  JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token Invalid'], 400);
        }
    }
}
