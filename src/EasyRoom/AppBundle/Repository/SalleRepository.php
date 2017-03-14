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

    public function searchSalle(SearchSalleBean $searchSalle) {

        /*
         * SOUS-REQUETE
         */

        // Paramètres de la sous-requête
        $subQueryParams = $this->buildSearchSalleSubQueryParams($searchSalle);

        $sqb = $this->getEntityManager()->createQueryBuilder();

        $and = $sqb->expr()->andX();

        // Conditions sur les dates (date début / date fin)
        $orDate = $sqb->expr()->orX();
        $orDate->add($sqb->expr()->between('reservationSQ.dateDebut', ':searchDateDebut', ':searcDateFin'));
        $orDate->add($sqb->expr()->between('reservationSQ.dateFin', ':searchDateDebut', ':searcDateFin'));
        $and->add($orDate);

        // Conditions sur les heures (heure début / heure fin)
        $orHeure = $sqb->expr()->orX();
        $orHeure->add($sqb->expr()->between('reservationSQ.heureDebut', ':searchHeureDebut', ':searchHeureFin'));
        $orHeure->add($sqb->expr()->between('reservationSQ.heureFin', ':searchHeureDebut', ':searchHeureFin'));
        $and->add($orHeure);


        $subQuery = $sqb
                ->select(['salleSQ.id'])
                ->from('EasyRoomAppBundle:Salle', 'salleSQ')
                ->innerJoin('salleSQ.reservations', 'reservationSQ')
                ->innerJoin('salleSQ.dispositionSalles', 'dispoSalleSQ')
                ->where($and)
                ->andWhere($sqb->expr()->gte('dispoSalleSQ.nbPlace', ':searchNbPlace'))
                ->andWhere($sqb->expr()->eq('dispoSalleSQ.dispositionDefaut', 1))
                ->setParameters($subQueryParams)
                ->getQuery()
        ;

        /*
         * REQUETE
         */

        $qb    = $this->getEntityManager()->createQueryBuilder();
        $query = $qb
                ->select('salle')
                ->from('EasyRoomAppBundle:Salle', 'salle')
                ->where($qb->expr()->notIn('salle.id', ':subQuery'))
                ->setParameter('subQuery', $subQuery->getArrayResult())
                ->getQuery()
        ;

        $result = $query->getResult();

        return $result;
    }

    /**
     * Fabrique la liste des paramètres utiles pour la sous-requête de la recherche des salles
     * 
     * @param SearchSalleBean $searchSalle
     * @return ArrayCollection
     */
    private function buildSearchSalleSubQueryParams(SearchSalleBean $searchSalle) {

        $dateDebut = DateTime::createFromFormat('Y-m-d', '1900-01-01');
        $dateFin = DateTime::createFromFormat('Y-m-d', '1900-01-01');
        $heureDebut = DateTime::createFromFormat('H:i', '00:00');
        $heureFin = DateTime::createFromFormat('H:i', '00:00');
        $nbPlace = 0;
        
        if (!is_null($searchSalle->getDateDebut()) && !is_null($searchSalle->getDateFin())) {
            $dateDebut = $searchSalle->getDateDebut()->format('Y-m-d');
            $dateFin = $searchSalle->getDateFin()->format('Y-m-d');
        }
        
        if (!is_null($searchSalle->getHeureDebut()) && !is_null($searchSalle->getHeureFin())) {
            $heureDebut = $searchSalle->getHeureDebut()->format('H:i');
            $heureFin = $searchSalle->getHeureFin()->format('H:i');
        }
        
        if (!is_null($searchSalle->getNbPlace())) {
            $nbPlace = $searchSalle->getNbPlace();
        }

        $subQueryParams = new ArrayCollection(array(
            new Parameter('searchDateDebut', $dateDebut),
            new Parameter('searcDateFin', $dateFin),
            new Parameter('searchHeureDebut', $heureDebut),
            new Parameter('searchHeureFin', $heureFin),
            new Parameter('searchNbPlace', $nbPlace)
        ));
        
        return $subQueryParams;
    }

}
