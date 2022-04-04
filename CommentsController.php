<?php

declare(strict_types=1);

namespace App\Controller\frontend;

use DateTimeImmutable;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\CommentsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CommentsController extends AbstractController
{
    /**
     * @Route("/commentaires", name="app_comments_commentaire")
     * 
     */
    public function commentaire(Request $request, CommentsRepository $commentsRepository): Response
    {
        $comments = new Comments();
        $form = $this->createForm(CommentsType::class, $comments);
        $form->handleRequest($request);
        $comments->setActive(false);
        if ($form->isSubmitted() && $form->isValid()) {

            $comments->setCreatedAt(new DateTimeImmutable());
            $em = $this->getDoctrine()->getManager();


            $parentid = $form->get("parent")->getData();
            if ($parentid != null) {
                $parent = $em->getRepository(Comments::class)->find($parentid);
            }
            $comments->setParent($parent ?? null);

            $em->persist($comments);
            $em->flush();

            $this->addFlash('success', 'Votre commentaires a bien été envoyer');
            return $this->redirectToRoute('app_comments_commentaire');
        }


        return $this->render(
            'frontend/commentaire.html.twig',
            [
                'form' => $form->createView(),
                'comments' =>  $commentsRepository->findAll(),
            ]
        );
    }
    /**
     * @Route("/commentaires/{id}/delete", name="app_comments_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Comments $comments): Response
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($comments);
        $em->flush();

        return $this->render(
            'frontend/deleteCommentaire.html.twig',
            [
                '$comments' => $comments,
            ]
        );
    }
}
