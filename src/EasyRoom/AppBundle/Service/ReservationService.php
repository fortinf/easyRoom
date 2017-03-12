<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Service;

use Doctrine\ORM\EntityManager;
use EasyRoom\AppBundle\Entity\Reservation;

/**
 * Description of ReservationService
 *
 * @author ffortin
 */
class ReservationService {

    private $em;
    private $equipementService;
    private $salleService;
    private $utilisateurService;

    public function __construct(EntityManager $entityManager, SalleService $salleSrv, UtilisateurService $utilisateurSrv,EquipementService $equipementSrv) {
        $this->em = $entityManager;
        $this->salleService = $salleSrv;
        $this->utilisateurService = $utilisateurSrv;
        $this->equipementService = $equipementSrv;
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

        // Salle
        $salle = $this->salleService->getById($idSalle);
        $reservation->setSalle($salle);

        // Utilisateuru maître
        $utilisateurMaitre = $this->utilisateurService->getById($idUtilisateurMaitre);
        $reservation->setUtilisateurMaitre($utilisateurMaitre);

        // Utilisateurs participants
        foreach ($idUtilisateurs as $idUtilisateur) {
            $utilisateur = $this->utilisateurService->getById($idUtilisateur);
            $reservation->addUtilisateur($utilisateur);
        }

        // Invités externes
        foreach ($inviteExternes as $inviteExterne) {
            $reservation->addInviteExterne($inviteExterne);
        }

        // Equipements
        foreach ($idEquipements as $idEquipement) {
            $equipement = $this->equipementService->getById($idEquipement);
            $reservation->addEquipement($equipement);
        }

        $this->em->persist($reservation);
        $this->em->flush();

        return $reservation->getId();
    }
    
    /**
     * Fonction de modification d'une réservation
     * 
     * @param Reservation $reservation
     * @param array $idUtilisateurs
     * @param array $idEquipements
     * @param array $inviteExternes
     */
    public function update($id, Reservation $reservation, array $idUtilisateurs, array $idEquipements, array $inviteExternes) {
        
    }

}
