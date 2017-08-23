<?php

namespace EasyRoom\AppBundle\Repository;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Parameter;
use EasyRoom\AppBundle\Bean\SearchSalleBean;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SalleRepository
 *
 * @author ffortin
 */
class SalleRepository
        extends EntityRepository {

    /**
     * Recherche les salles libres pour des critères d'effectif et de dates donnés
     * 
     * @param SearchSalleBean $searchSalle
     * @return type
     */
    public function searchUnusedSalle(SearchSalleBean $searchSalle) {

        /*
         * SOUS-REQUETE
         * Sélectionne les salles en conflits de dates/heures
         */
        $resultSQ = $this->createSubQueryDateConflict($searchSalle);

        /*
         * REQUETE
         */
        $queryParams = $this->buildSearchSalleQueryParams($searchSalle, $resultSQ);

        $qb    = $this->getEntityManager()->createQueryBuilder();
        $query = $qb
                ->select('salle')
                ->from('EasyRoomAppBundle:Salle', 'salle')
                ->innerJoin('salle.dispositionSalles', 'dispoSalle')
                ->where($qb->expr()->eq(1, 1));

        if (!empty($resultSQ)) {
            $query->andWhere($qb->expr()->notIn('salle.id', ':subQuery'));
        }

        $query->andWhere($qb->expr()->gte('dispoSalle.nbPlace', ':searchNbPlace'))
                ->andWhere($qb->expr()->eq('dispoSalle.dispositionDefaut', 1))
                ->setParameters($queryParams);

        $result = $query->getQuery()->getResult();

        return $result;
    }

    /**
     * Sélectionne les salles en conflits de dates/heures
     * Critères de recherche:
     *  Si l'idSalle est non null, alors on restreint la recherche sur cette salle
     * 
     * @param SearchSalleBean $searchSalle
     * @return type
     */
    private function createSubQueryDateConflict(SearchSalleBean $searchSalle) {
        /*
         * SOUS-REQUETE
         */

        // Paramètres de la sous-requête
        $subQueryParams = $this->buildSearchSalleSubQueryParams($searchSalle);

        $sqb = $this->getEntityManager()->createQueryBuilder();

        // Conditions sur les dates (date début / date fin)
        
        /*
         * DateDebut < Resa DateDebut & DateFin > Resa DateFin
         * 
         * DateDebut       Resa DateDebut           Resa DateFin         DateFin
         *     |----------------||-----------------------||----------------|
         * 
         */
        $andDate1 = $sqb->expr()->andX();
        $andDate1->add($sqb->expr()->lt(':searchDateDebut', 'reservationSQ.dateDebut'));
        $andDate1->add($sqb->expr()->gt(':searcDateFin', 'reservationSQ.dateFin'));
        
        /*
         * Resa DateDebut < DateDebut and DateFin < Resa DateFin
         * 
         * Resa DateDebut      DateDebut          DateFin         Resa DateFin
         *     ||-----------------|------------------|------------------||
         * 
         */
        $andDate2 = $sqb->expr()->andX();
        $andDate2->add($sqb->expr()->gt(':searchDateDebut', 'reservationSQ.dateDebut'));
        $andDate2->add($sqb->expr()->lt(':searcDateFin', 'reservationSQ.dateFin'));

        $orDate   = $sqb->expr()->orX();
        
        /*
         * DateDebut < Resa DateDebut < DateFin
         * 
         * DateDebut          Resa DateDebut          DateFin
         *     |--------------------||------------------|
         * 
         */
        $orDate->add($sqb->expr()->between('reservationSQ.dateDebut', ':searchDateDebut', ':searcDateFin'));
        
        /*
         * DateDebut < Resa DateDebut < DateFin
         * 
         * DateDebut          Resa DateFin            DateFin
         *     |--------------------||------------------|
         * 
         */
        $orDate->add($sqb->expr()->between('reservationSQ.dateFin', ':searchDateDebut', ':searcDateFin'));
        
        $orDate->add($andDate1);
        $orDate->add($andDate2);

        $subQuery = $sqb
                ->select(['salleSQ.id'])
                ->from('EasyRoomAppBundle:Salle', 'salleSQ')
                ->innerJoin('salleSQ.reservations', 'reservationSQ')
                ->where($orDate)
                ->setParameters($subQueryParams)
                ->getQuery()
        ;

        return $subQuery->getArrayResult();
    }

    /**
     * Fabrique la liste des paramètres utiles pour la sous-requête de la recherche des salles
     * 
     * @param SearchSalleBean $searchSalle
     * @return ArrayCollection
     */
    private function buildSearchSalleSubQueryParams(SearchSalleBean $searchSalle) {

        $dateDebut = DateTime::createFromFormat('Y-m-d H:i', '1900-01-01 01:00');
        $dateFin   = DateTime::createFromFormat('Y-m-d H:i', '1900-01-01 01:01');

        if (!is_null($searchSalle->getDateDebut()) && !is_null($searchSalle->getDateFin())) {
            $dateDebut = $searchSalle->getDateDebut()->format('Y-m-d H:i');
            $dateFin   = $searchSalle->getDateFin()->format('Y-m-d H:i');
        }

        $subQueryParams = new ArrayCollection(array(
            new Parameter('searchDateDebut', $dateDebut),
            new Parameter('searcDateFin', $dateFin)
        ));

        return $subQueryParams;
    }

    /**
     * Fabrique la liste des paramètres utiles pour la requête principale
     * 
     * @param SearchSalleBean $searchSalle
     * @param array $subQueryArrayResult
     * @return ArrayCollection
     */
    private function buildSearchSalleQueryParams(SearchSalleBean $searchSalle, array $subQueryArrayResult) {

        $nbPlace = 0;
        $params  = array();

        if (!is_null($searchSalle->getNbPlace())) {
            $nbPlace = $searchSalle->getNbPlace();
        }
        array_push($params, new Parameter('searchNbPlace', $nbPlace));

        // 
        if (!is_null($subQueryArrayResult) && is_array($subQueryArrayResult) && !empty($subQueryArrayResult)) {
            array_push($params, new Parameter('subQuery', $subQueryArrayResult));
        }

        $queryParams = new ArrayCollection($params);

        return $queryParams;
    }

}
