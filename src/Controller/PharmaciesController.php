<?php

namespace App\Controller;

use App\Entity\Pharmacies;
use App\Form\PharmaciesType;
use App\Repository\PharmaciesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pharmacies")
 */
class PharmaciesController extends AbstractController
{
    /**
     * @Route("/", name="pharmacies_index", methods={"GET"})
     */
    public function index(PharmaciesRepository $pharmaciesRepository): Response
    {
        return $this->render('pharmacies/index.html.twig', [
            'pharmacies' => $pharmaciesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pharmacies_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pharmacy = new Pharmacies();
        $form = $this->createForm(PharmaciesType::class, $pharmacy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pharmacy);
            $entityManager->flush();

            return $this->redirectToRoute('pharmacies_index');
        }

        return $this->render('pharmacies/new.html.twig', [
            'pharmacy' => $pharmacy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pharmacies_show", methods={"GET"})
     */
    public function show(Pharmacies $pharmacy): Response
    {
        return $this->render('pharmacies/show.html.twig', [
            'pharmacy' => $pharmacy,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pharmacies_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pharmacies $pharmacy): Response
    {
        $form = $this->createForm(PharmaciesType::class, $pharmacy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pharmacies_index');
        }

        return $this->render('pharmacies/edit.html.twig', [
            'pharmacy' => $pharmacy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pharmacies_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pharmacies $pharmacy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pharmacy->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pharmacy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pharmacies_index');
    }
}
