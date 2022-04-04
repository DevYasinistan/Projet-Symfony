<?php

declare(strict_types=1);

namespace App\Controller\frontend;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RgpdController extends AbstractController
{
    /**
     * @Route("/confidentialite", name="app_rgpd_conf")
     */
    public function conf()
    {

        return $this->render("frontend/rgpd.html.twig");
    }

    /**
     * @Route("/mentions-legale", name="app_rgpd_mention")
     */
    public function mention()
    {

        return $this->render("frontend/mentions-légale.html.twig");
    }
}
