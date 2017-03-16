<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of SalleController
 *
 * @author ffortin
 */
class SalleController
        extends Controller {

    public function indexAction() {
        return $this->render('EasyRoomAppBundle:Salle:index.html.twig');
    }

    public function searchAction(Request $request) {

        if ($request->isMethod('POST')) {
            $postEffectif   = $request->request->get("effectif");
            $postDateDebut  = $request->request->get("date_debut"); // ex: 20 mars, 2017
            $postDateFin    = $request->request->get("date_fin"); // ex: 10:00
            $postHeureDebut = $request->request->get("heure_debut");
            $postHeureDFin  = $request->request->get("heure_fin");
            
            
            var_dump($request);
            
            $postDateHeureDebut = $postDateDebut . ' ' . $postHeureDebut;
            var_dump($postDateHeureDebut);
            
            
            $dateDebut = DateTime::createFromFormat('d/m/Y H:i', $postDateHeureDebut);
            
            
            var_dump($dateDebut);
        }

        return $this->render('EasyRoomAppBundle:Salle:search_salle.html.twig');
    }

}
