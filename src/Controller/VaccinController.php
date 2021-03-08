<?php

namespace App\Controller;

use App\Entity\Vaccin;
use App\Form\VaccinType;
use App\Repository\VaccinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vaccin")
 */
class VaccinController extends AbstractController
{
    /**
     * @Route("/", name="vaccin_index", methods={"GET"})
     */
    public function index(VaccinRepository $vaccinRepository): Response
    {
        return $this->render('vaccin/index.html.twig', [
            'vaccins' => $vaccinRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vaccin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vaccin = new Vaccin();
        $form = $this->createForm(VaccinType::class, $vaccin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vaccin);
            $entityManager->flush();

            return $this->redirectToRoute('vaccin_index');
        }

        return $this->render('vaccin/new.html.twig', [
            'vaccin' => $vaccin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vaccin_show", methods={"GET"})
     */
    public function show(Vaccin $vaccin): Response
    {
        return $this->render('vaccin/show.html.twig', [
            'vaccin' => $vaccin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vaccin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vaccin $vaccin): Response
    {
        $form = $this->createForm(VaccinType::class, $vaccin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vaccin_index');
        }

        return $this->render('vaccin/edit.html.twig', [
            'vaccin' => $vaccin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vaccin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vaccin $vaccin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vaccin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vaccin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vaccin_index');
    }
}
