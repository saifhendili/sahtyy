<?php

namespace App\Controller;

use App\Entity\Reservaide;
use App\Form\ReservaideType;
use App\Repository\FormAideRepository;
use App\Repository\ReservaideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservaide")
 */
class ReservaideController extends AbstractController
{
    /**
     * @Route("/", name="reservaide_index", methods={"GET"})
     */
    public function index(ReservaideRepository $reservaideRepository): Response
    {
        return $this->render('form_aide/reservalid_index.html.twig', [
            'reservaides' => $reservaideRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/new", name="reservaide_new", methods={"GET","POST"})
     */
    public function new(Request $request,FormAideRepository $FormAideRepository, $id): Response
    {
        $FormAide=$FormAideRepository->find($id);
        $reservaide = new Reservaide();
        $form = $this->createForm(ReservaideType::class, $reservaide);
        $form->handleRequest($request);


        $user = $this->getUser()->getId();


        if ($form->isSubmitted() && $form->isValid()) {
            $FormAide->changeQuantit($FormAide->getQuantit());
            $reservaide->setIdPatient($user);
            $reservaide->setIdAide($FormAide->getId());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservaide);
            $entityManager->flush();

            return $this->redirectToRoute('form_aide_index');
        }

        return $this->render('form_aide/reservalid_new.html.twig', [
            'reservaide' => $reservaide,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservaide_show", methods={"GET"})
     */
    public function show(Reservaide $reservaide): Response
    {
        return $this->render('form_aide/reservalid_show.html.twig', [
            'reservaide' => $reservaide,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservaide_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservaide $reservaide): Response
    {
        $form = $this->createForm(ReservaideType::class, $reservaide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservaide_index');
        }

        return $this->render('form_aide/edit.html.twig', [
            'reservaide' => $reservaide,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservaide_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reservaide $reservaide): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservaide->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservaide);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservaide_index');
    }
}
