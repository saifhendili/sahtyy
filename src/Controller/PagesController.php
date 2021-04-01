<?php

namespace App\Controller;

use PhpParser\Node\Stmt\Return_;
use Symfony\Bridge\Twig\Node\RenderBlockNode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MercurySeries\FlashyBundle\FlashyNotifier;
class PagesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(FlashyNotifier $flashy): Response
    {
      
        $flashy->success('nouvel vaccin est disponible!', 'vaccin');
        return $this->redirectToRoute('vaccin_index');
    }
     /**
     * @Route("/flash", name="flash")
     */
    public function about()
    {
        return $this->render('pages/home.html.twig');
    }
}

