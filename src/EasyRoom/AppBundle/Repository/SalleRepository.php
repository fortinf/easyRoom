<?php

use Doctrine\ORM\EntityRepository;

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

    public function searchSalle() {

        $query = $this->getEntityManager()->createQuery(
                ''
        );
    }

}
