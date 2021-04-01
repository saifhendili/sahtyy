<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConseilsController extends AbstractController
{
    /**
     * @Route("/conseils", name="conseils")
     */
    public function index(): Response
    {
        return $this->render('conseils/index.html.twig', [
            'controller_name' => 'ConseilsController',
        ]);
    }
}
