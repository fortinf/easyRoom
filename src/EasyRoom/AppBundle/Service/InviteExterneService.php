<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Service;

use Doctrine\ORM\EntityManager;
use EasyRoom\AppBundle\Entity\InviteExterne;

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
     * Retourne un invité externe depuis un id
     * 
     * @param integer $id
     * @return InviteExterne
     */
    public function getById($id) {
        if (!is_null($id) && is_int($id)) {
            $repository = $this->em->getRepository('EasyRoomAppBundle:InviteExterne');
            return $repository->find($id);
        } else {
            return NULL;
        }
    }
    

}
