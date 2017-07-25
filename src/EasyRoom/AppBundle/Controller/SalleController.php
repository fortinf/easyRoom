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
use EasyRoom\AppBundle\Form\SalleType;
use Proxies\__CG__\EasyRoom\AppBundle\Entity\Salle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Description of SalleController
 *
 * @author ffortin
 */
class SalleController
        extends Controller {

    public function listAction() {
        $salleService = $this->container->get('salle.service');
        $salles       = $salleService->getAll();

        return $this->render('EasyRoomAppBundle:Salle:list.html.twig', array(
                    'salles' => $salles,
        ));
    }

    /**
     * 
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request) {
        $salle = new Salle();
        $form  = $this->get('form.factory')->create(SalleType::class, $salle);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {

                // Liste des dispositions
                $dispositionService = $this->container->get('disposition.service');
                $dispositionBeans   = $dispositionService->buildListDispositionBean($salle);

                // Création de la salle
                $salleService = $this->container->get('salle.service');

                $salleService->create($salle, $dispositionBeans, array());

                $request->getSession()->getFlashBag()->add('success', 'Salle créée.');

                // Redirection vers l'écran de gestion des salles
                return $this->redirectToRoute('easy_room_app_salle');
            }
        }

        return $this->render('EasyRoomAppBundle:Salle:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request, $idSalle) {
        
        $intIdSalle = intval($idSalle);

        $salleService = $this->container->get('salle.service');
        $salle        = $salleService->getById($intIdSalle);

        if (is_null($salle)) {
            $salle = new Salle();

            // TODO : exception
            throw new NotFoundHttpException("La salle d'id " . $idSalle . " n'existe pas.");
        }

        $form = $this->get('form.factory')->create(SalleType::class, $salle);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                
                // Liste des dispositions
                $dispositionService = $this->container->get('disposition.service');
                $dispositionBeans   = $dispositionService->buildListDispositionBean($salle);

                // MOdification de la salle
                $salleService->update($intIdSalle, $salle, $dispositionBeans);

                $request->getSession()->getFlashBag()->add('success', 'Salle modifiée.');

                // Redirection vers l'écran de gestion des salles
                return $this->redirectToRoute('easy_room_app_salle_edit', array(
                            'idSalle' => $idSalle,
                            'salle'   => $salle,
                ));
            }
        }

        return $this->render('EasyRoomAppBundle:Salle:edit.html.twig', array(
                    'form'  => $form->createView(),
                    'salle' => $salle,
        ));
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

            $salleService = $this->container->get('salle.service');
            $salles       = $salleService->search($searchSalle);
        }

        return $this->render('EasyRoomAppBundle:Salle:search_salle.html.twig', array(
                    'salles' => $salles
        ));
    }

    public function showAction($idSalle) {

        $salle = null;

        $id = intval($idSalle);

        if (isset($id) && is_int($id)) {
            $salleService = $this->container->get('salle.service');
            $salle        = $salleService->getById($id);
        }

        if (!isset($salle)) {
            $salle = new Salle();
        }

        return $this->render('EasyRoomAppBundle:Salle:fiche.html.twig', array(
                    'salle' => $salle
        ));
    }

}
