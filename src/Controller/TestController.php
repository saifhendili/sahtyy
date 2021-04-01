<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('Dashbord/admin.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    /**
     * @Route("/showProfil", name="Profil")
     */
    public function showProfil(): Response
    {
        return $this->render('profil/MedecinProfil.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    /**
     * @Route("/stats", name="stats")
     */
    public function statistiques(CategoriesRepository $categRepo)
    {
       $categories = $categRepo->findAll();
        $categNom= [];
        $categCount= [];
   foreach ($categories as $categorie) {
   $categNom[] = $categorie ->getName();
  //$categCount[] = COUNT ($categorie->getUser());

}
       return $this->render('Dashbord/stats.html.twig', [
            'categNom' => json_encode($categNom),
            'categcount' => json_encode($categCount),
        ]);
    }
}
