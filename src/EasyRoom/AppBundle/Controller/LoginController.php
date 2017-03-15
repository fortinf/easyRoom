<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of LoginController
 *
 * @author ffortin
 */
class LoginController
        extends Controller {

    public function indexAction() {
        return $this->render('EasyRoomAppBundle:Login:index.html.twig');
    }

    public function authentificationAction() {

        $utilisateurService = $this->container->get('utilisateur.service');
        $utilisateur        = $utilisateurService->getById(1);

        // Liste des réservations propriétaires de l'utilisateur courant
        $reservationMaitres = $utilisateur->getReservationProprietaires();

        // Liste des réservations invitées de l'utilisateur courant
        $reservationInvites = $utilisateur->getReservations();


        // Redirection vers la page d'accueil
        return $this->render('EasyRoomAppBundle:Accueil:accueil.html.twig', array(
                    'reservationsMaitres' => $reservationMaitres,
                    'reservationInvites'  => $reservationInvites
        ));
    }

}
