<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Service;

use Doctrine\ORM\EntityManager;
use EasyRoom\AppBundle\Entity\InviteExterne;
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
    private $inviteExterneService;

    public function __construct(EntityManager $entityManager, SalleService $salleSrv, UtilisateurService $utilisateurSrv, EquipementService $equipementSrv, InviteExterneService $inviteExterneSrv) {
        $this->em                   = $entityManager;
        $this->salleService         = $salleSrv;
        $this->utilisateurService   = $utilisateurSrv;
        $this->equipementService    = $equipementSrv;
        $this->inviteExterneService = $inviteExterneSrv;
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

        if (!is_null($reservation) && $reservation instanceof Reservation && !is_null($idSalle) && is_int($idSalle) && !is_null($idUtilisateurMaitre) && is_int($idUtilisateurMaitre) && !is_null($idUtilisateurs) && is_array($idUtilisateurs) && !is_null($idEquipements) && is_array($idEquipements) && !is_null($inviteExternes) && is_array($inviteExternes)) {
            // Salle
            $salle = $this->salleService->getById($idSalle);
            if (!is_null($salle)) {
                $reservation->setSalle($salle);
            }

            // Utilisateur maître
            $utilisateurMaitre = $this->utilisateurService->getById($idUtilisateurMaitre);
            if (!is_null($utilisateurMaitre)) {
                $reservation->setUtilisateurMaitre($utilisateurMaitre);
            }

            // Utilisateurs participants
            foreach ($idUtilisateurs as $idUtilisateur) {
                if (!is_null($idUtilisateur) && is_int($idUtilisateur)) {
                    $utilisateur = $this->utilisateurService->getById($idUtilisateur);
                    if (!is_null($utilisateur)) {
                        $reservation->addUtilisateur($utilisateur);
                    }
                }
            }

            // Invités externes
            foreach ($inviteExternes as $inviteExterne) {
                if (!is_null($inviteExterne) && $inviteExterne instanceof InviteExterne) {
                    $reservation->addInviteExterne($inviteExterne);
                }
            }

            // Equipements
            foreach ($idEquipements as $idEquipement) {
                if (!is_null($idEquipement) && is_int($idEquipement)) {
                    $equipement = $this->equipementService->getById($idEquipement);
                    if (!is_null($equipement)) {
                        $reservation->addEquipement($equipement);
                    }
                }
            }

            $this->em->persist($reservation);
            $this->em->flush();

            return $reservation->getId();
        } else {
            return NULL;
        }
    }

    /**
     * Fonction de modification d'une réservation
     * 
     * @param Reservation $reservation
     * @param array $idUtilisateurs
     * @param array $idEquipements
     * @param array $inviteExternes
     */
    public function update($idReservation, Reservation $reservation) {
        if (!is_null($idReservation) && is_int($idReservation) && !is_null($reservation) && $reservation instanceof Reservation) {
            $repository        = $this->em->getRepository('EasyRoomAppBundle:Reservation');
            $updateReservation = $repository->find($idReservation);
            if (!is_null($updateReservation)) {
                $updateReservation->setLibelle($reservation->getLibelle());
                $updateReservation->setDateDebut($reservation->getDateDebut());
                $updateReservation->setDateFin($reservation->getDateFin());
                $this->em->persist($reservation);
                $this->em->flush();
            }
        }
    }

    /**
     * Retourne une réservation depuis un id
     * 
     * @param integer $id
     * @return Reservation
     */
    public function getById($id) {
        if (!is_null($id) && is_int($id)) {
            $repository = $this->em->getRepository('EasyRoomAppBundle:Reservation');
            return $repository->find($id);
        } else {
            return NULL;
        }
    }

    /**
     * Ajout d'un utilisateur sur une réservation
     * 
     * @param integer $idReservation
     * @param integer $idUtilisateur
     */
    public function addUtilisateur($idReservation, $idUtilisateur) {
        if (!is_null($idReservation) && is_int($idReservation) && !is_null($idUtilisateur) && is_int($idUtilisateur)) {
            $reservation = $this->getById($idReservation);
            $utilisateur = $this->utilisateurService->getById($idUtilisateur);
            if (!is_null($reservation) && !is_null($utilisateur)) {
                $reservation->addUtilisateur($utilisateur);
                $this->em->persist($reservation);
                $this->em->flush();
            }
        }
    }

    /**
     * Suppression d'un utilisateur d'une réservation
     * 
     * @param integer $idReservation
     * @param integer $idUtilisateur
     */
    public function removeUtilisateur($idReservation, $idUtilisateur) {
        if (!is_null($idReservation) && is_int($idReservation) && !is_null($idUtilisateur) && is_int($idUtilisateur)) {
            $reservation = $this->getById($idReservation);
            $utilisateur = $this->utilisateurService->getById($idUtilisateur);
            if (!is_null($reservation) && !is_null($utilisateur)) {
                $reservation->removeUtilisateur($utilisateur);
                $this->em->persist($reservation);
                $this->em->flush();
            }
        }
    }

    /**
     * Ajout d'un équipement sur une création
     * 
     * @param type $idReservation
     * @param type $idEquipement
     */
    public function addEquipement($idReservation, $idEquipement) {
        if (!is_null($idReservation) && is_int($idReservation) && !is_null($idEquipement) && is_int($idEquipement)) {
            $reservation = $this->getById($idReservation);
            $equipement  = $this->equipementService->getById($idEquipement);
            if (!is_null($reservation) && !is_null($equipement)) {
                $reservation->addEquipement($equipement);
                $this->em->persist($reservation);
                $this->em->flush();
            }
        }
    }

    /**
     * Suppression d'un équipement d'une réservation
     * 
     * @param integer $idReservation
     * @param integer $idEquipement
     */
    public function removeEquipement($idReservation, $idEquipement) {
        if (!is_null($idReservation) && is_int($idReservation) && !is_null($idEquipement) && is_int($idEquipement)) {
            $reservation = $this->getById($idReservation);
            $equipement  = $this->equipementService->getById($idEquipement);
            if (!is_null($reservation) && !is_null($equipement)) {
                $reservation->removeEquipement($equipement);
                $this->em->persist($reservation);
                $this->em->flush();
            }
        }
    }

    /**
     * Ajout d'un invité externe sur une réservation
     * 
     * @param integer $idReservation
     * @param integer $idInviteExterne
     */
    public function addInviteExterne($idReservation, $idInviteExterne) {
        if (!is_null($idReservation) && is_int($idReservation) && !is_null($idInviteExterne) && is_int($idInviteExterne)) {
            $reservation   = $this->getById($idReservation);
            $inviteExterne = $this->inviteExterneService->getById($idInviteExterne);
            if (!is_null($reservation) && !is_null($inviteExterne)) {
                $reservation->addInviteExterne($inviteExterne);
                $this->em->persist($reservation);
                $this->em->flush();
            }
        }
    }

    /**
     * Suppression d'un invité externe d'une réservation
     * 
     * @param integer $idReservation
     * @param integer $idInviteExterne
     */
    public function removeInviteExterne($idReservation, $idInviteExterne) {
        if (!is_null($idReservation) && is_int($idReservation) && !is_null($idInviteExterne) && is_int($idInviteExterne)) {
            $reservation   = $this->getById($idReservation);
            $inviteExterne = $this->inviteExterneService->getById($idInviteExterne);
            if (!is_null($reservation) && !is_null($inviteExterne)) {
                $reservation->removeInviteExterne($inviteExterne);
                $this->em->persist($reservation);
                $this->em->flush();
            }
        }
    }

}
