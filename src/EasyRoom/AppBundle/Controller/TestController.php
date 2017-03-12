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

/**
 * Description of TestController
 *
 * @author ffortin
 */
class TestController extends Controller {
    
    public function indexAction()
    {
        /*
        // SALLE
        $salleService = $this->container->get('salle.service');

        $salle = new Salle();
        $salle->setLibelle('Salle test 2');
        $salle->setDescription('Ceci est une salle de test 2');
        $salle->setDisponible(FALSE);
        $salle->setHandicap(TRUE);
        $salle->setLumiereJour(TRUE);

        $dispositionSalle1 = new DispositionSalle();
        $dispositionSalle1->setNbPlace(15);
        $dispositionSalle1->setDispositionDefaut(FALSE);

        $dispositionSalle2 = new DispositionSalle();
        $dispositionSalle2->setNbPlace(40);
        $dispositionSalle2->setDispositionDefaut(TRUE);

        $tabDispositionSalles = array(
            '1' => $dispositionSalle1,
            '2' => $dispositionSalle2
        );

        $salleService->update(2, $salle, $tabDispositionSalles);
        
        
        // UTILISATEUR
        $roleService = $this->container->get('role.service');
        $role = $roleService->getRoleById(2);
        
        $administrateur = new Utilisateur();
        $administrateur->setNom('Paul');
        $administrateur->setPrenom('O\'Connor');
        $administrateur->setMail('olivier.oconnor@yopmail.com');
        $administrateur->setMotDePasse('xhg_p^rtu)');
        $administrateur->setRole($role);
        
        $utilisateurService = $this->container->get('utilisateur.service');
        $utilisateurService->update(1, $administrateur);
        
        // EQUIPEMENT
        $typeEquipementService = $this->container->get('typeequipement.service');
        $typeEquipementVideoProjecteur = $typeEquipementService->getTypeEquipementById(3);
        $typeEquipementTelephone = $typeEquipementService->getTypeEquipementById(2);
        
        
        $equipementService = $this->container->get('equipement.service');
        $equipement1 = new Equipement();
        $equipement1->setLibelle('Viewsonic PRO8520WL');
        $equipement1->setDescription("2 entrées VGA, 3D ready, Correction de trapèze horizontal, Lens Shift, MHL, orateur intégré >=8  Watts, Télécommande");
        $equipement1->setReference('VID-PRO_001');
        $equipement1->setMobilite(TRUE);
        $equipement1->setDisponible(TRUE);
        $equipement1->setTypeEquipement($typeEquipementVideoProjecteur);
        $equipementService->create($equipement1);
        
        $equipement2 = new Equipement();
        $equipement2->setLibelle('Konftel 250');
        $equipement2->setDescription("Conçu pour des locaux de 30 à 70 m², le téléphone de conférence Konftel "
                . "250 est adapté pour des réunions rassemblant jusque 10 personnes. Doté d'un écran LCD rétro-éclairé "
                . "et d'un clavier de numérotation, ce téléphone de conférence intègre les principales fonctions d'un "
                . "téléphone comme un répertoire d'une capacité de stockage de 50 numéros.");
        $equipement2->setReference('TEL_001');
        $equipement2->setMobilite(FALSE);
        $equipement2->setDisponible(TRUE);
        $equipement2->setTypeEquipement($typeEquipementTelephone);
        $equipementService->create($equipement2);
         * 
         */
        
        // RESERVATION
        $reservation = new Reservation();
        $reservation->setLibelle('Projet easyRoom : dailyscrum');
        $reservation->setDateDebut(DateTime::createFromFormat('d/m/Y', '01/12/2016'));
        $reservation->setDateFin(DateTime::createFromFormat('d/m/Y', '01/12/2016'));
        $reservation->setHeureDebut(DateTime::createFromFormat('H:i', '14:00'));
        $reservation->setHeureFin(DateTime::createFromFormat('H:i', '15:30'));
        
        // Salle
        $salleService = $this->container->get('salle.service');
        $salle = $salleService->getById(1);
        
        // Utilisateurs occupants
        $idUtilisateurs = array(2, 3);
        
        // Equipements
        $idEquipements = array();
        
        // occupants externe 
        $inviteExternes = array();
        $inviteExterne1 = new InviteExterne();
        $inviteExterne1->setNom('Martin');
        $inviteExterne1->setPrenom('David');
        $inviteExterne1->setMail('david.martin@yopmail.com');
        $inviteExterne1->setEntreprise('ECOVert');
        array_push($inviteExternes, $inviteExterne1);
        
        $inviteExterne2 = new InviteExterne();
        $inviteExterne2->setNom('Moreau');
        $inviteExterne2->setPrenom('Vanessa');
        $inviteExterne2->setMail('vanessa.moreau@yopmail.com');
        $inviteExterne2->setEntreprise('ECOVert');
        array_push($inviteExternes, $inviteExterne2);
        
        // MAJ de la 2nd réservation
        $em = $this->getDoctrine()->getManager();
        $repoReservation = $em->getRepository('EasyRoomAppBundle:Reservation');
        $reservation2 = $repoReservation->find(2);
        

        $collUtilisateurs = $reservation2->getUtilisateurs();
        //$utilisateur = $collUtilisateurs->last();
        //$reservation2->removeUtilisateur($utilisateur);
        
        
        //$repoUtilisateur = $em->getRepository('EasyRoomAppBundle:Utilisateur');
        //$utilisateur4 = $repoUtilisateur->find(4);
        //$reservation2->addUtilisateur($utilisateur4);
        
        $em->persist($reservation2);
        $em->flush();
        
        
        // Création de la réservation
        //$reservationService = $this->container->get('reservation.service');
        //$reservationService->create($reservation, 1, 1, $idUtilisateurs, $idEquipements, $inviteExternes);

        return $this->render('EasyRoomAppBundle::test.html.twig', array(
            'salle' => $salle,
            'reservation' => $reservation2
        ));
    }
    
}
