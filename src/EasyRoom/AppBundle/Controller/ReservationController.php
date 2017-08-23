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
        $libSalle       = '';

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
            $libSalle     = $salle->getLibelle();
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
                    'libSalle'   => $libSalle,
        ));
    }

    public function submitAddAction(Request $request) {

        $reservation = new Reservation();
        $utilisateur = $this->getUser();
        $libSalle    = '';

        $form = $this->get('form.factory')->create(ReservationType::class, $reservation, array(
            'idUtilisateur' => $utilisateur->getId(),
        ));

        if ($request->isMethod('POST')) {

            $postDateDebut  = $request->request->get("date_debut"); // ex: 20 mars, 2017
            $postHeureDebut = $request->request->get("heure_debut"); // ex: 10:00
            $postDateFin    = $request->request->get("date_fin");
            $postHeureFin   = $request->request->get("heure_fin");

            $form->handleRequest($request);

            $salle = $reservation->getSalle();

            if ($form->isValid() && !is_null($salle)) {
                
                $libSalle = $salle->getLibelle();

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

                // Gestion des conflits
                $reservationService = $this->container->get('reservation.service');
                if (!$reservationService->searchConflicts($salle->getId(), $dateDebut, $dateFin)) {
                    // Création
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($reservation);
                    $em->flush();

                    return $this->redirectToRoute('index');
                } else {
                    $request->getSession()->getFlashBag()->add('error', 'Création impossible! La salle est déjà réservée pour la période désirée.');
                }
            } else {
                $request->getSession()->getFlashBag()->add('error', 'Erreurs de données');
            }
        }

        return $this->render('EasyRoomAppBundle:Reservation:add.html.twig', array(
                    'form'       => $form->createView(),
                    'dateDebut'  => $postDateDebut,
                    'dateFin'    => $postDateFin,
                    'heureDebut' => $postHeureDebut,
                    'heureFin'   => $postHeureFin,
                    'libSalle'   => $libSalle,
        ));
    }

}
