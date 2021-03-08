<?php

namespace App\Controller;

use App\Entity\ReservationMed;
use App\Form\ReservationMedType;
use App\Repository\MedicamentsRepository;
use App\Repository\ReservationMedRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation/med")
 */
class ReservationMedController extends AbstractController
{
    /**
     * @Route("/", name="reservation_med_index", methods={"GET"})
     */
    public function index(ReservationMedRepository $reservationMedRepository): Response
    {
        return $this->render('medicaments/reser_index.html.twig', [
            'reservation_meds' => $reservationMedRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/new", name="reservation_med_new", methods={"GET","POST"})
     */
    public function new(Request $request, MedicamentsRepository $medicamentsRepository,$id): Response
    {
        $medicament=$medicamentsRepository->find($id);
        $reservationMed = new ReservationMed();
        $form = $this->createForm(ReservationMedType::class, $reservationMed);
        $form->handleRequest($request);
        $user = $this->getUser()->getId();
    
      
          
        if ($form->isSubmitted() && $form->isValid()) {
            $reservationMed->setIdPatient($user);
            $reservationMed->setIdMed($medicament->getId());
            $reservationMed->setIdPhar($medicament->getIdPharmacie());


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservationMed);
            $entityManager->flush();

            return $this->redirectToRoute('medicaments_index');
        }

        return $this->render('medicaments/reser_new.html.twig', [
            'reservation_med' => $reservationMed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_med_show", methods={"GET"})
     */
    public function show(ReservationMed $reservationMed): Response
    {
        return $this->render('medicaments/reser_show.html.twig', [
            'reservation_med' => $reservationMed,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservation_med_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ReservationMed $reservationMed): Response
    {
        $form = $this->createForm(ReservationMedType::class, $reservationMed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_med_index');
        }

        return $this->render('medicaments/reser_edit.html.twig', [
            'reservation_med' => $reservationMed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_med_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ReservationMed $reservationMed): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationMed->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservationMed);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_med_index');
    }
}
