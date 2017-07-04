<?php

namespace EasyRoom\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AccueilController
        extends Controller {

    /**

     * @Security("has_role('ROLE_USER')")

     */
    public function indexAction() {
        $utilisateurService = $this->container->get('utilisateur.service');
        $utilisateur        = $utilisateurService->getById(1);

        $reservationInvites = null;
        $reservationMaitres = null;
        if($utilisateur != null) {
            // Liste des réservations propriétaires de l'utilisateur courant
            $reservationMaitres = $utilisateur->getReservationProprietaires();

            // Liste des réservations invitées de l'utilisateur courant
            $reservationInvites = $utilisateur->getReservations();
        }


        // Redirection vers la page d'accueil
        return $this->render('EasyRoomAppBundle:Accueil:accueil.html.twig', array(
                    'reservationsMaitres' => $reservationMaitres,
                    'reservationInvites'  => $reservationInvites
        ));
    }

}
