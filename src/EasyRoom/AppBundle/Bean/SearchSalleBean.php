<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Bean;

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
     * @var Date
     */
    private $dateDebut;
    
    /**
     *
     * @var integer 
     */
    private $dureeHeure;
    
    /**
     *
     * @var integer 
     */
    private $dureeJour;
    
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
    
    public function __construct($libelle, $nbPlace, Date $dateDebut, $dureeHeure, $dureeJour, $lumiereJour, $handicap) {
        $this->libelle = $libelle;
        $this->nbPlace = $nbPlace;
        $this->dateDebut = $dateDebut;
        $this->dureeHeure = $dureeHeure;
        $this->dureeJour = $dureeJour;
        $this->lumiereJour = $lumiereJour;
        $this->handicap = $handicap;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function getNbPlace() {
        return $this->nbPlace;
    }

    public function getDateDebut(): Date {
        return $this->dateDebut;
    }

    public function getDureeHeure() {
        return $this->dureeHeure;
    }

    public function getDureeJour() {
        return $this->dureeJour;
    }

    public function getLumiereJour() {
        return $this->lumiereJour;
    }

    public function getHandicap() {
        return $this->handicap;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
        return $this;
    }

    public function setNbPlace($nbPlace) {
        $this->nbPlace = $nbPlace;
        return $this;
    }

    public function setDateDebut(Date $dateDebut) {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    public function setDureeHeure($dureeHeure) {
        $this->dureeHeure = $dureeHeure;
        return $this;
    }

    public function setDureeJour($dureeJour) {
        $this->dureeJour = $dureeJour;
        return $this;
    }

    public function setLumiereJour($lumiereJour) {
        $this->lumiereJour = $lumiereJour;
        return $this;
    }

    public function setHandicap($handicap) {
        $this->handicap = $handicap;
        return $this;
    }

}
