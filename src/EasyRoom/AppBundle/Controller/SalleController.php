<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Controller;

use DateInterval;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use EasyRoom\AppBundle\Bean\SearchSalleBean;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of SalleController
 *
 * @author ffortin
 */
class SalleController
        extends Controller {

    public function creationAction() {

        return $this->render('EasyRoomAppBundle:Salle:creation.html.twig');
    }

    public function searchAction(Request $request) {

        $salles = new ArrayCollection();

        if ($request->isMethod('POST')) {

            $postEffectif   = $request->request->get("effectif");
            $postDateDebut  = $request->request->get("date_debut"); // ex: 20 mars, 2017
            $postDateFin    = $request->request->get("date_fin"); // ex: 10:00
            $postHeureDebut = $request->request->get("heure_debut");
            $postHeureFin   = $request->request->get("heure_fin");

            $searchSalle = new SearchSalleBean();

            // Effectif
            if (!empty($postEffectif)) {
                $searchSalle->setNbPlace(intval($postEffectif));
            }

            // Date et heure de début
            if (!empty($postDateDebut)) {
                if (empty($postHeureDebut)) {
                    $postHeureDebut = '00:01';
                }
                $postDateHeureDebut = $postDateDebut . ' ' . $postHeureDebut;
                $dateDebut          = DateTime::createFromFormat('d/m/Y H:i', $postDateHeureDebut);
            } else {
                $dateDebut = new DateTime();
                $dateDebut->setTime(0, 1, 0);
            }

            if ($dateDebut !== FALSE) {
                $searchSalle->setDateDebut($dateDebut);
            }
            
            var_dump($postDateDebut);

            // Date et heure de fin
            if (!empty($postDateFin)) {
                if (empty($postHeureFin)) {
                    $postHeureFin = '23:59';
                }
                $postDateHeureFin = $postDateFin . ' ' . $postHeureFin;
                $dateFin          = DateTime::createFromFormat('d/m/Y H:i', $postDateHeureFin);
            } elseif (!empty($postDateDebut)) {
                $postDateHeureFin = $postDateDebut . ' ' . $postHeureDebut;
                $dateFin          = DateTime::createFromFormat('d/m/Y H:i', $postDateHeureFin);
            } else {
                $dateFin = new DateTime();
                $dateFin->setTime(0, 1, 0);
            }

            if ($dateFin !== FALSE) {
                $searchSalle->setDateFin($dateFin);
            }

            var_dump($searchSalle);

            $salleService = $this->container->get('salle.service');
            $salles       = $salleService->search($searchSalle);
        }

        return $this->render('EasyRoomAppBundle:Salle:search_salle.html.twig', array(
                    'salles' => $salles
        ));
    }

    public function affichageAction() {
        return $this->render('EasyRoomAppBundle:Salle:fiche.html.twig');
    }

}
