<?php

namespace App\Controller;

use App\Repository\VaccinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    /**
     * @Route("/panieer", name="cart_indexe")
     */
    public function index(SessionInterface $session, VaccinRepository $VaccinsRepository)
    {
        $panier = $session->get('panier', []);
        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'Vaccin' => $VaccinsRepository->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach ($panierWithData as $item) {
            $totalitem = $item['Vaccin']->getPrix() * $item['quantity'];
            $total += $totalitem;
        }
        return $this->render('teste.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }
    /**
     * @Route("/paniere/add{id}", name="cart_adde")
     */
    public function add($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("cart_indexe");
    }

    /**
     * @Route("/paniere/removee/{id}", name="cart_removee")
     */
    public function remove($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]); //dégommage
        }

        $session->set('panier', $panier);
        return $this->redirectToRoute("cart_indexe");
    }
}
