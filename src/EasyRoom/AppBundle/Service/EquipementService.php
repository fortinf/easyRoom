<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Service;

use Doctrine\ORM\EntityManager;
use EasyRoom\AppBundle\Entity\Equipement;

/**
 * Description of EquipementService
 *
 * @author ffortin
 */
class EquipementService {
    
    private $em;
    
    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    /**
     * Fonction de création d'un équipement
     * 
     * @param Equipement $equipement
     */
    public function create(Equipement $equipement) {
        $this->em->persist($equipement);
        $this->em->flush();
    }
    
    /**
     * 
     * Function de modification d'un équipement
     * 
     * @param integer $id
     * @param Equipement $equipement
     */
    public function update($id, Equipement $equipement) {
        
        $repository = $this->em->getRepository('EasyRoomAppBundle:Equipement');
        $updateEquipement = $repository->find($id);
        
        // Informations de base
        $updateEquipement->setLibelle($equipement->getLibelle());
        $updateEquipement->setDescription($equipement->getDescription());
        $updateEquipement->setReference($equipement->getReference());
        
        // Type équipement
        $updateEquipement->setTypeEquipement($equipement->getTypeEquipement());
        
        // Modification de l'équipement
        $this->em->persist($updateEquipement);
        $this->em->flush();
    }
    
}
