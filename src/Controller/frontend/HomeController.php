<?php

declare(strict_types=1);

namespace App\Controller\frontend;

use App\Entity\Images;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_frontend_home")
     */
    public function home(): Response
    {

        $repository = $this->getDoctrine()->getRepository(Images::class);

        $images = $repository->findAll();

        return $this->render('frontend/home.html.twig', [
            'images' => $images,
        ]);
    }
}
