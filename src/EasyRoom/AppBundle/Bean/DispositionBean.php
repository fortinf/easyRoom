<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Bean;

/**
 * Description of DispositionBean
 *
 * @author ffortin
 */
class DispositionBean {
    
    private $id;
            
    private $nbPlace;
    
    private $dispositionDefaut;
    
    public function getId() {
        return $this->id;
    }

    public function getNbPlace() {
        return $this->nbPlace;
    }

    public function getDispositionDefaut() {
        return $this->dispositionDefaut;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNbPlace($nbPlace) {
        $this->nbPlace = $nbPlace;
        return $this;
    }

    public function setDispositionDefaut($dispositionDefaut) {
        $this->dispositionDefaut = $dispositionDefaut;
        return $this;
    }


    
}
