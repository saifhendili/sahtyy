<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\FormAide;
use App\Form\FormAideType;
use App\Form\SearchForm;
use App\Repository\FormAideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/form/aide")
 */
class FormAideController extends AbstractController
{
    /**
     * @Route("/", name="form_aide_index", methods={"GET"})
     */
    public function index(FormAideRepository $formAideRepository, Request $request): Response
    {
        $data=new SearchData();
        $form=$this->createForm(SearchForm::class, $data);
        $form->handleRequest($request); 

        $products=$formAideRepository->findSearch($data);
        return $this->render('form_aide/index.html.twig', [
            'form_aides' => $products,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/new", name="form_aide_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formAide = new FormAide();
        $form = $this->createForm(FormAideType::class, $formAide);
        $form->handleRequest($request);
        $user = $this->getUser()->getId();
     
     
     
        if ($form->isSubmitted() && $form->isValid()) {
            $formAide->setIdUser($user);
            $formAide->setNom($this->getUser()->getNom());
            $formAide->setPrenom($this->getUser()->getPrenom());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formAide);
            $entityManager->flush();

            return $this->redirectToRoute('form_aide_index');
        }

        return $this->render('form_aide/new.html.twig', [
            'form_aide' => $formAide,
            'form' => $form->createView(),
        ]);
    
}
    /**
     * @Route("/{id}", name="form_aide_show", methods={"GET"})
     */
    public function show(FormAide $formAide): Response
    {
        return $this->render('form_aide/show.html.twig', [
            'form_aide' => $formAide,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="form_aide_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FormAide $formAide): Response
    {
        $form = $this->createForm(FormAideType::class, $formAide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('form_aide_index');
        }

        return $this->render('form_aide/edit.html.twig', [
            'form_aide' => $formAide,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="form_aide_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FormAide $formAide): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formAide->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formAide);
            $entityManager->flush();
        }

        return $this->redirectToRoute('form_aide_index');
    }
}
