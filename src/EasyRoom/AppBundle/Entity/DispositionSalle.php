<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salle
 *
 * @ORM\Table(name="T_DISPOSITION_SALLE", indexes={
 *      @ORM\Index(name="TDS_FK_SAL_ID", columns={"TDS_FK_SAL_ID"}),
 *      @ORM\Index(name="TDS_FK_DIS_ID", columns={"TDS_FK_DIS_ID"})
 *      })
 * @ORM\Entity
 */
class DispositionSalle {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="TDS_NB_PLACE", type="smallint", nullable=false)
     */
    private $nbPlace;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="TDS_DISPOSITION_DEFAUT", type="boolean", nullable=false)
     */
    private $dispositionDefaut;
    
    /**
     * @var Salle
     * 
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Salle", inversedBy="dispositionSalles") 
     * @ORM\JoinColumn(name="TDS_FK_SAL_ID", referencedColumnName="SAL_ID", nullable=false)
     */
    private $salle;
    
    /**
     * @var Disposition
     * 
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Disposition", inversedBy="dispositionSalles") 
     * @ORM\JoinColumn(name="TDS_FK_DIS_ID", referencedColumnName="DIS_ID", nullable=false)
     */
    private $disposition;
    
    /**
     * Get nbPlace
     * 
     * @return integer
     */
    public function getNbPlace()
    {
        return $this->nbPlace;
    }

    /**
     * Set nbPlace
     * 
     * @param integer $nbPlace
     * 
     * @return DispositionSalle
     */
    public function setNbPlace($nbPlace)
    {
        $this->nbPlace = $nbPlace;
        
        return $this;
    }

    /**
     * Get dispositionDefaut
     * 
     * @return boolean
     */
    public function getDispositionDefaut()
    {
        return $this->dispositionDefaut;
    }

    /**
     * Set dispositionDefaut
     * 
     * @param boolean $dispositionDefaut
     * 
     * @return DispositionSalle
     */
    public function setDispositionDefaut($dispositionDefaut)
    {
        $this->dispositionDefaut = $dispositionDefaut;
        
        return $this;
    }

     
        
    /**
     * Set disposition
     *
     * @param Disposition $disposition
     *
     * @return Reservation
     */
    public function setDisposition(Disposition $disposition = null)
    {
        $this->disposition = $disposition;

        return $this;
    }

    /**
     * Get salle
     *
     * @return Disposition
     */
    public function getDisposition()
    {
        return $this->disposition;
    }
    
    /**
     * Set salle
     *
     * @param Salle $salle
     *
     * @return Reservation
     */
    public function setSalle(Salle $salle = null)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return Salle
     */
    public function getSalle()
    {
        return $this->salle;
    }
}
