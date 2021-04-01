<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\User;
use App\Form\CategoriesType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index(): Response
    {
        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }
    /**
     * @Route("/cat", name="cat", methods={"GET","POST"})
     */


    public function new(Request $request): Response
    {
        $categorie= new Categories();
        $form = $this->createForm(CategoriesType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('home_index');
        }

        return $this->render('categories/index.html.twig', [
            'categories' => $categorie,
            'form' => $form->createView(),
        ]);
    }
}
