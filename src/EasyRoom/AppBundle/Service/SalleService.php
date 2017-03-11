<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Service;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use EasyRoom\AppBundle\Bean\SearchSalle;
use EasyRoom\AppBundle\Entity\Salle;

/**
 * Description of SalleService
 *
 * @author ffortin
 */
class SalleService {

    /**
     *
     * @var EntityManager 
     */
    private $em;

    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    /**
     * Fonction de création d'une salle
     * 
     * @param Salle $salle
     * @param Collection $dispositionSalles
     * @return integer
     */
    public function create(Salle $salle, Collection $dispositionSalles) {
 
        // TODO : faire les contrôles de gestion

        // Rattachement des dispositions de la salle
        $arrayDispositionSalles = $dispositionSalles->toArray();
        foreach ($arrayDispositionSalles as $dispositionSalle) {
            
            // Création de la relation entre la disposition et la salle
            $dispositionSalle->setSalle($salle);
            $this->em->persist($dispositionSalle);
            
            // Affectation de la relation au niveau de la salle
            $salle->addDispositionSalle($dispositionSalle);
        }
        
        // TODO : Rattacher les équipements
        
        // Création de la salle
        $this->em->persist($salle);
        $this->em->flush();
        
        return $salle->getId();
    }
    
    /**
     * 
     * Fonction de mise à jour de la salle
     * 
     * @param integer $id
     * @param Salle $salle
     * @param array $tabDispositionSalles
     */
    public function update($id, Salle $salle, array $tabDispositionSalles) {
        
        $repository = $this->em->getRepository('EasyRoomAppBundle:Salle');
        
        $udpateSalle = $repository->find($id);
        
        // Informations de base
        $udpateSalle->setLibelle($salle->getLibelle());
        $udpateSalle->setDescription($salle->getDescription());
        $udpateSalle->setDisponible($salle->getDisponible());
        $udpateSalle->setHandicap($salle->getHandicap());
        $udpateSalle->setLumiereJour($salle->getLumiereJour());
        
        // Dispostions
        $arrayDispositionSalles = $udpateSalle->getDispositionSalles()->toArray();
        foreach ($arrayDispositionSalles as $newDispositionSalle) {
            $dispositionSalle = $tabDispositionSalles[$newDispositionSalle->getDisposition()->getId()];
            $newDispositionSalle->setNbPlace($dispositionSalle->getNbPlace());
            $newDispositionSalle->setDispositionDefaut($dispositionSalle->getDispositionDefaut());
        }
        
        // TODO : Equipements
        
        
        // Modification de la salle
        $this->em->persist($udpateSalle);
        $this->em->flush();
        
    }
    
    public function getSalleById($id) {
        $repository = $this->em->getRepository('EasyRoomAppBundle:Salle');
        return $repository->find($id);
    }
    
    /**
     * Fonction qui retourne toutes les salles
     * 
     * @return type
     */
    public function getAllSalle() {
        $repository = $this->em->getRepository('EasyRoomAppBundle:Salle');
        return $repository->findAll();
    }
    
    /**
     * Fonction de recherche de salles
     * 
     * @param SearchSalle $searchSalle
     */
    public function search(SearchSalle $searchSalle) {
        
    }

}
