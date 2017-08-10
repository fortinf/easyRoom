<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Controller;

use EasyRoom\AppBundle\Entity\Reservation;
use EasyRoom\AppBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DateTime;

/**
 * Description of ReservationController
 *
 * @author ffortin
 */
class ReservationController
        extends Controller {

    public function addAction(Request $request, $idSalle) {

        $reservation = new Reservation();
        $utilisateur = $this->getUser();

        $postDateDebut  = '';
        $postDateFin    = '';
        $postHeureDebut = '';
        $postHeureFin   = '';

        if ($request->isMethod('POST')) {
            $postDateDebut  = $request->request->get("date_debut"); // ex: 20 mars, 2017
            $postDateFin    = $request->request->get("date_fin"); // ex: 10:00
            $postHeureDebut = $request->request->get("heure_debut");
            $postHeureFin   = $request->request->get("heure_fin");
        }

        if (!is_null($idSalle)) {
            $salleService = $this->container->get('salle.service');
            $salle        = $salleService->getById(intval($idSalle));
            $reservation->setSalle($salle);
        }

        $form = $this->get('form.factory')->create(ReservationType::class, $reservation, array(
            'idUtilisateur' => $utilisateur->getId(),
        ));

        return $this->render('EasyRoomAppBundle:Reservation:add.html.twig', array(
                    'form'       => $form->createView(),
                    'dateDebut'  => $postDateDebut,
                    'dateFin'    => $postDateFin,
                    'heureDebut' => $postHeureDebut,
                    'heureFin'   => $postHeureFin,
        ));
    }

    public function submitAddAction(Request $request) {

        $reservation = new Reservation();
        $utilisateur = $this->getUser();

        $form = $this->get('form.factory')->create(ReservationType::class, $reservation, array(
            'idUtilisateur' => $utilisateur->getId(),
        ));

        if ($request->isMethod('POST')) {

            $postDateDebut  = $request->request->get("date_debut"); // ex: 20 mars, 2017
            $postHeureDebut = $request->request->get("heure_debut"); // ex: 10:00
            $postDateFin    = $request->request->get("date_fin");
            $postHeureFin   = $request->request->get("heure_fin");

            $form->handleRequest($request);

            if ($form->isValid()) {

                // Propriétaire de la réservation : utilisateur connecté
                $reservation->setUtilisateurMaitre($utilisateur);

                // Date début
                $postDateHeureDebut = $postDateDebut . ' ' . $postHeureDebut;
                $dateDebut          = DateTime::createFromFormat('d/m/Y H:i', $postDateHeureDebut);
                $reservation->setDateDebut($dateDebut);

                // Date fin
                $postDateHeureFin = $postDateFin . ' ' . $postHeureFin;
                $dateFin          = DateTime::createFromFormat('d/m/Y H:i', $postDateHeureFin);
                $reservation->setDateFin($dateFin);

                // Création
                $em = $this->getDoctrine()->getManager();
                $em->persist($reservation);
                $em->flush();
            }
        }

        return $this->redirectToRoute('index');
    }

}
