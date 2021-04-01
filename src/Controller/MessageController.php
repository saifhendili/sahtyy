<?php

namespace App\Controller;

use PhpParser\Node\Stmt\Return_;
use Symfony\Bridge\Twig\Node\RenderBlockNode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MercurySeries\FlashyBundle\FlashyNotifier;

class MessageController extends AbstractController

{
    /**
     * @Route("/flashy", name="message")
     */
    public function message(FlashyNotifier $flashy): Response

    {
        $flashy->info('La metformine traitement du diabète type 2 Glucophage, Stagid sont de nouveaux disponible chez pharamashop ', 'http://your-awesome-link.com');
        return $this->redirectToRoute('about');
    }

/**
     * @Route("/mesg", name="about")
     */
    public function about(){
        return $this->render('message/about.html.twig');

    }



}

