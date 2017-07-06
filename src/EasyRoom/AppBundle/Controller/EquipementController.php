<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Controller;

use EasyRoom\AppBundle\Entity\Equipement;
use EasyRoom\AppBundle\Form\EquipementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of EquipementController
 *
 * @author ffortin
 */
class EquipementController
        extends Controller {

    public function listAction() {

        $equipementService = $this->container->get('equipement.service');
        $equipements       = $equipementService->getAll();

        return $this->render('EasyRoomAppBundle:Equipement:list.html.twig', array(
                    'equipements' => $equipements,
        ));
    }

    public function addAction(Request $request) {

        $equipement = new Equipement();
        $form       = $this->get('form.factory')->create(EquipementType::class, $equipement);

        // Si la requête est en POST
        if ($request->isMethod($request::METHOD_POST)) {

            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            if ($form->isValid()) {

                // Maj du flag "disponible" 
                if (!is_null($equipement->getSalle())) {
                    $equipement->setMobilite(FALSE);
                } else {
                    $equipement->setMobilite(TRUE);
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($equipement);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Équipement créé.');

                return $this->render('EasyRoomAppBundle:Equipement:add.html.twig', array(
                            'form' => $form->createView(),
                ));
            }
        }

        return $this->render('EasyRoomAppBundle:Equipement:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function editAction($idEquipement, Request $request) {

        $equipementService = $this->container->get('equipement.service');


        $idEquipementInt = intval($idEquipement);
        $equipement      = $equipementService->getById($idEquipementInt);


        if (is_null($equipement)) {
            $request->getSession()->getFlashBag()->add('error', 'Équipement non trouvé.');
            $equipement = new Equipement();
        }

        $form = $this->get('form.factory')->create(EquipementType::class, $equipement);

        // Si la requête est en POST
        if ($request->isMethod($request::METHOD_POST)) {

            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            if ($form->isValid()) {

                // Maj du flag "disponible" 
                if (!is_null($equipement->getSalle())) {
                    $equipement->setMobilite(FALSE);
                } else {
                    $equipement->setMobilite(TRUE);
                }

                $equipementService->update(intval($idEquipement), $equipement);

                $request->getSession()->getFlashBag()->add('info', 'Équipement modifié.');

                return $this->render('EasyRoomAppBundle:Equipement:edit.html.twig', array(
                            'form'         => $form->createView(),
                            'idEquipement' => $idEquipementInt,
                ));
            }
        }

        return $this->render('EasyRoomAppBundle:Equipement:edit.html.twig', array(
                    'form'         => $form->createView(),
                    'idEquipement' => $idEquipementInt,
        ));
    }

}
