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
 * Description of InviteExterneService
 *
 * @author ffortin
 */
class InviteExterneService {

    private $em;

    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    /**
     * Fonction de création d'un invité externe
     * 
     * @param InviteExterne $inviteExterne
     * @return integer
     */
    public function create(InviteExterne $inviteExterne, Reservation $reservation) {
        $inviteExterne->setReservation($reservation);
        $this->em->persist($inviteExterne);
        $this->flush();
        return $inviteExterne->getId();
    }

    /**
     * Fonction de modification d'un invité externe
     * 
     * @param integer $id
     * @param InviteExterne $inviteExterne
     */
    public function update($id, InviteExterne $inviteExterne) {

        $repository = $this->em->getRepository('EasyRoomAppBundle:InviteExterne');
        $updateInviteExterne = $repository->find($id);

        // Informations de base
        $updateInviteExterne->setNom($inviteExterne->getNom());
        $updateInviteExterne->setPrenom($inviteExterne->getPrenom());
        $updateInviteExterne->setMail($inviteExterne->getMail());
        $updateInviteExterne->setEntreprise($inviteExterne->getEntreprise());

        // Réservation
        $updateInviteExterne->setReservation($inviteExterne->getReservation());

        // Modification de l'invité externe
        $this->em->persist($updateInviteExterne);
        $this->em->flush();
    }

    /**
     * Fonction de suppression d'un invité externe
     * 
     * @param type $id
     */
    public function remove($id) {

        $repository = $this->em->getRepository('EasyRoomAppBundle:InviteExterne');
        $inviteExterne = $repository->find($id);
        
        $this->em->remove($inviteExterne);
        $this->em->flush();
        
    }

}
