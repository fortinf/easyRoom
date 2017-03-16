<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Controller;

use DateTime;
use EasyRoom\AppBundle\Bean\SearchSalleBean;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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


        $searchSalle = new SearchSalleBean();
        
        
        $searchSalle->setDateDebut(DateTime::createFromFormat('Y-m-d H:i', '2017-03-20 10:00'));
        $searchSalle->setDateFin(DateTime::createFromFormat('Y-m-d H:i', '2017-03-20 11:00'));
        $searchSalle->setNbPlace(5);
        


        $em             = $this->getDoctrine()->getManager();
        $easyRepository = $em->getRepository('EasyRoomAppBundle:Salle');
        //$salles = $easyRepository->searchSalle($searchSalle);
        $salles = $easyRepository->searchSalle($searchSalle);
        
        var_dump($salles);

        return $this->render('EasyRoomAppBundle::test.html.twig', array(
                    'salle'       => NULL,
                    'reservation' => NULL,
                    'utilisateur' => $utilisateur
        ));
    }

}
