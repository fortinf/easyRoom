<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of DispositionRepository
 *
 * @author ffortin
 */
class DispositionRepository
        extends EntityRepository {

    public function getAllQueryBuilder() {
        return $this->createQueryBuilder('d');
    }

}
