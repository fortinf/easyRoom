<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * Description of RoleService
 *
 * @author ffortin
 */
class RoleService {

    private $em;

    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    /**
     * Fonction de recherche d'un rôle depuis son id
     * 
     * @param type $id
     * @return type
     */
    public function getById($id) {
        if (!is_null($id) && is_int($id)) {
            $repository = $this->em->getRepository('EasyRoomAppBundle:Role');
            return $repository->find($id);
        } else {
            return NULL;
        }
    }

    /**
     * 
     * @return mixed
     */
    public function getAll() {
        $repository = $this->em->getRepository('EasyRoomAppBundle:Role');
        return $repository->findAll();
    }

}
