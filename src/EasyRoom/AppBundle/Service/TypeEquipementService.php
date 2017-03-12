<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * Description of TypeEquipementService
 *
 * @author ffortin
 */
class TypeEquipementService {
    
    private $em;
    
    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }
    
    public function getById($id) {
        $repository = $this->em->getRepository('EasyRoomAppBundle:TypeEquipement');
        return $repository->find($id);
    }
    
    public function getAll() {
        $repository = $this->em->getRepository('EasyRoomAppBundle:TypeEquipement');
        return $repository->findAll();
    }

    
}
