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

    public function addAction(Request $request) {

        $equipement = new Equipement;
        $form       = $this->get('form.factory')->create(EquipementType::class, $equipement);

        // Si la requête est en POST
        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
                // On enregistre notre objet $advert dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $em->persist($equipement);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Équipement créé.');

                // On redirige vers la page de visualisation de l'annonce nouvellement créée
                return $this->render('EasyRoomAppBundle:Equipement:add.html.twig', array(
                    'form' => $form->createView(),
        ));
            }
        }

        return $this->render('EasyRoomAppBundle:Equipement:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
