<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Service;

use Doctrine\ORM\EntityManager;
use EasyRoom\AppBundle\Entity\Reservation;
use EasyRoom\AppBundle\Entity\Utilisateur;

/**
 * Description of ReservationService
 *
 * @author ffortin
 */
class ReservationService {

    private $em;

    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    /**
     * 
     * Fonction de création d'une réservation
     * 
     * @param Reservation $reservation
     * @param integer $idSalle
     * @param integer $idUtilisateurMaitre
     * @param array $idUtilisateurs
     * @param array $idEquipements
     * @param array $inviteExternes
     * @return integer
     */
    public function create(Reservation $reservation, $idSalle, $idUtilisateurMaitre, array $idUtilisateurs, array $idEquipements, array $inviteExternes) {


        $repoUtilisateur = $this->em->getRepository('EasyRoomAppBundle:Utilisateur');
        $repoSalle = $this->em->getRepository('EasyRoomAppBundle:Salle');

        // Salle
        $salle = $repoSalle->find($idSalle);
        $salle->addReservation($reservation);
        $this->em->persist($salle);
        $reservation->setSalle($salle);
        
        // Utilisateuru maître
        $utilisateurMaitre = $repoUtilisateur->find($idUtilisateurMaitre);
        $utilisateurMaitre->addReservationProprietaire($reservation);
        $this->em->persist($utilisateurMaitre);
        $reservation->setUtilisateurMaitre($utilisateurMaitre);
        
        // Utilisateurs participants
        foreach ($idUtilisateurs as $idUtilisateur) {
            $utilisateur = $repoUtilisateur->find($idUtilisateur);
            $utilisateur->addReservation($reservation);
            $this->em->persist($utilisateur);
            $reservation->addUtilisateur($utilisateur);
        }

        // Invités externes
        foreach ($inviteExternes as $inviteExterne) {
            $inviteExterne->setReservation($reservation);
            $this->em->persist($inviteExterne);
            $reservation->addInviteExterne($inviteExterne);
        }

        // Equipements
        if (count($idEquipements) > 0) {
            $repoEquipement = $this->em->getRepository('EasyRoomAppBundle:Equipement');
            foreach ($idEquipements as $idEquipement) {
                $equipement = $repoEquipement->find($idEquipement);
                $equipement->addReservation($reservation);
                $this->em->persist($equipement);
                $reservation->addEquipement($equipement);
            }
        }
        
        $this->em->persist($reservation);
        $this->em->flush();

        return $reservation->getId();
    }

}
