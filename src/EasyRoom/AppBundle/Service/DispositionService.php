<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * Description of DispositionService
 *
 * @author ffortin
 */
class DispositionService {
    
    private $em;
    
    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }
    
    public function getDispositionById($id) { 
        $repository = $this->em->getRepository('EasyRoomAppBundle:Disposition');
        return $repository->find($id);
    }
}
