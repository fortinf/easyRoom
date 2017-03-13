<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Controller;

use DateTime;
use EasyRoom\AppBundle\Entity\InviteExterne;
use EasyRoom\AppBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Exception;

/**
 * Description of TestController
 *
 * @author ffortin
 */
class TestController
        extends Controller {

    public function indexAction() {
        $salleService       = $this->container->get('salle.service');
        $equipementService  = $this->container->get('equipement.service');
        $utilisateurService = $this->container->get('utilisateur.service');
        $reservationService = $this->container->get('reservation.service');

        $utilisateur = NULL;

        
        $utilisateur = $utilisateurService->getById(1);
 

        return $this->render('EasyRoomAppBundle::test.html.twig', array(
                    'salle'       => NULL,
                    'reservation' => NULL,
                    'utilisateur' => $utilisateur
        ));
    }

}
