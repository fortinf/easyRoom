<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Repository;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Parameter;


/**
 * Description of ReservationRepository
 *
 * @author ffortin
 */
class ReservationRepository
        extends EntityRepository {

    /**
     * Recherche les réservations en conflits pour une salle
     * 
     * @param integer $idSalle
     * @param DateTime $dateDebut
     * @param DateTime $dateFin
     */
    public function searchBySalle($idSalle, DateTime $dateDebut, DateTime $dateFin) {

        $qb    = $this->getEntityManager()->createQueryBuilder();
        
        /*
         * DateDebut < Resa DateDebut and Resa DateFin < DateFin
         * 
         * DateDebut       Resa DateDebut           Resa DateFin         DateFin
         *     |----------------||-----------------------||----------------|
         * 
         */
        $andDate1 = $qb->expr()->andX();
        $andDate1->add($qb->expr()->lt(':searchDateDebut', 'reservation.dateDebut'));
        $andDate1->add($qb->expr()->gt(':searcDateFin', 'reservation.dateFin'));
        
        /*
         * Resa DateDebut < DateDebut and DateFin < Resa DateFin
         * 
         * Resa DateDebut      DateDebut          DateFin         Resa DateFin
         *     ||-----------------|------------------|------------------||
         * 
         */
        $andDate2 = $qb->expr()->andX();
        $andDate2->add($qb->expr()->gt(':searchDateDebut', 'reservation.dateDebut'));
        $andDate2->add($qb->expr()->lt(':searcDateFin', 'reservation.dateFin'));
        
        $orDate   = $qb->expr()->orX();
        
        /*
         * DateDebut < Resa DateDebut < DateFin
         * 
         * DateDebut          Resa DateDebut          DateFin
         *     |--------------------||------------------|
         * 
         */
        $orDate->add($qb->expr()->between('reservation.dateDebut', ':searchDateDebut', ':searcDateFin'));
        
        /*
         * DateDebut < Resa DateDebut < DateFin
         * 
         * DateDebut          Resa DateFin            DateFin
         *     |--------------------||------------------|
         * 
         */
        $orDate->add($qb->expr()->between('reservation.dateFin', ':searchDateDebut', ':searcDateFin'));
        $orDate->add($andDate1);
        $orDate->add($andDate2);
        
        
        $subQueryParams = new ArrayCollection(array(
            new Parameter('searchDateDebut', $dateDebut->format('Y-m-d H:i')),
            new Parameter('searcDateFin', $dateFin->format('Y-m-d H:i'))
        ));
        

        
        $query = $qb
                ->select('reservation')
                ->from('EasyRoomAppBundle:Reservation', 'reservation')
                ->innerJoin('reservation.salle', 'salle')
                ->where($qb->expr()->eq('salle.id', $idSalle))
                ->andWhere($orDate)
                ->setParameters($subQueryParams);
        
        return $query->getQuery()->getResult();
        
    }

}
