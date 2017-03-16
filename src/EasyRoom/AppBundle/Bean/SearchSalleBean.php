<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Bean;

use DateTime;

/**
 * Description of SearchSalle
 *
 * @author ffortin
 */
class SearchSalleBean {
    
    /**
     *
     * @var string 
     */
    private $libelle;
    
    /**
     *
     * @var integer 
     */
    private $nbPlace;
    
    /**
     *
     * @var DateTime
     */
    private $dateDebut;
    
    /**
     *
     * @var DateTime 
     */
    private $dateFin;
    
    /**
     *
     * @var boolean 
     */
    private $lumiereJour;
    
    /**
     *
     * @var boolean 
     */
    private $handicap;
    
    public function __construct() {
        $this->libelle     = '';
        $this->nbPlace     = 0;
        $this->dateDebut   = DateTime::createFromFormat('Y-m-d', '1900-01-01');
        $this->dateFin     = DateTime::createFromFormat('Y-m-d', '1900-01-01');
        $this->lumiereJour = FALSE;
        $this->handicap    = FALSE;
    }

        public function getLibelle() {
        return $this->libelle;
    }

    public function getNbPlace() {
        return $this->nbPlace;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function getLumiereJour() {
        return $this->lumiereJour;
    }

    public function getHandicap() {
        return $this->handicap;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    public function setNbPlace($nbPlace) {
        $this->nbPlace = $nbPlace;
    }

    public function setDateDebut(DateTime $dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    public function setDateFin(DateTime $dateFin) {
        $this->dateFin = $dateFin;
    }

    public function setLumiereJour($lumiereJour) {
        $this->lumiereJour = $lumiereJour;
    }

    public function setHandicap($handicap) {
        $this->handicap = $handicap;
    }


    
}
