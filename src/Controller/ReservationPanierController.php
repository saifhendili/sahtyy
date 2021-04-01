<?php

namespace App\Controller;

use App\Entity\ReservationPanier;
use App\Form\ReservationPanierType;
use App\Repository\ReservationPanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation/panier")
 */
class ReservationPanierController extends AbstractController
{
    /**
     * @Route("/", name="reservation_panier_index", methods={"GET"})
     */
    public function index(ReservationPanierRepository $reservationPanierRepository): Response
    {
        return $this->render('reservation_panier/index.html.twig', [
            'reservation_paniers' => $reservationPanierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/", name="reservation_panier_new", methods={"GET","POST"})
     */
    public function new(Request $request , SessionInterface $session): Response
    {
        $panier = $session->get('panier', []);
        $reservationPanier = new ReservationPanier();
        $form = $this->createForm(ReservationPanierType::class, $reservationPanier);
        $form->handleRequest($request);
        $user = $this->getUser()->getId();
        $username = $this->getUser()->getNom();
        
        if ($form->isSubmitted() && $form->isValid()) {
            $reservationPanier->setUserid($user);
            $reservationPanier->setUsername($username);
            
            foreach ($panier as $id ) {
                $item[] = $id;
            }
          
            $reservationPanier->setItems($item);
            $reservationPanier->setPrix("33");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservationPanier);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_panier_index');
        }

        return $this->render('reservation_panier/new.html.twig', [
            'reservation_panier' => $reservationPanier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_panier_show", methods={"GET"})
     */
    public function show(ReservationPanier $reservationPanier): Response
    {
        return $this->render('reservation_panier/show.html.twig', [
            'reservation_panier' => $reservationPanier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservation_panier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ReservationPanier $reservationPanier): Response
    {
        $form = $this->createForm(ReservationPanierType::class, $reservationPanier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_panier_index');
        }

        return $this->render('reservation_panier/edit.html.twig', [
            'reservation_panier' => $reservationPanier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_panier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ReservationPanier $reservationPanier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationPanier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservationPanier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_panier_index');
    }
}
