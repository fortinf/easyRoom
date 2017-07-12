<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Service;

use Doctrine\ORM\EntityManager;
use EasyRoom\AppBundle\Bean\DispositionBean;
use Proxies\__CG__\EasyRoom\AppBundle\Entity\Salle;

/**
 * Description of DispositionService
 *
 * @author ffortin
 */
class DispositionService {

    private $em;
    private $idDispoRectangle;
    private $idDispoConference;
    private $idDispoClasse;
    private $idDispoVide;

    public function __construct(EntityManager $entityManager, $paramIdDispoRectangle, $paramIdDispoConference, $paramIdDispoClasse, $paramIdDispoVide) {
        $this->em = $entityManager;
        $this->idDispoRectangle = $paramIdDispoRectangle;
        $this->idDispoConference = $paramIdDispoConference;
        $this->idDispoClasse = $paramIdDispoClasse;
        $this->idDispoVide = $paramIdDispoVide;
    }

    public function getById($id) {
        if (!is_null($id) && is_int($id)) {
            $repository = $this->em->getRepository('EasyRoomAppBundle:Disposition');
            return $repository->find($id);
        } else {
            return NULL;
        }
    }

    public function getAll() {
        $repository = $this->em->getRepository('EasyRoomAppBundle:Disposition');
        return $repository->findAll();
    }
    
    /**
     * Construit un tableau de DispositionBean avec les données de la salle en paramètre
     * 
     * @param Salle $salle
     * @param integer $idDispositionParDefaut
     * @return array
     */
    public function buildListDispositionBean(Salle $salle) {
        
        $idDispositionParDefaut = $salle->getDispositionDefaut()->getId();

        $dispositionBeanRectangle = new DispositionBean();
        $dispositionBeanRectangle->setId($this->idDispoRectangle);
        $dispositionBeanRectangle->setNbPlace($salle->getCapaciteRectangle());
        $dispositionBeanRectangle->setDispositionDefaut(($this->idDispoRectangle === $idDispositionParDefaut) ? TRUE : FALSE);
        
        $dispositionBeanConference = new DispositionBean();
        $dispositionBeanConference->setId($this->idDispoConference);
        $dispositionBeanConference->setNbPlace($salle->getCapaciteConference());
        $dispositionBeanConference->setDispositionDefaut(($this->idDispoConference === $idDispositionParDefaut) ? TRUE : FALSE);
        
        $dispositionBeanClasse = new DispositionBean();
        $dispositionBeanClasse->setId($this->idDispoClasse);
        $dispositionBeanClasse->setNbPlace($salle->getCapaciteClasse());
        $dispositionBeanClasse->setDispositionDefaut(($this->idDispoClasse === $idDispositionParDefaut) ? TRUE : FALSE);
        
        $dispositionBeanVide = new DispositionBean();
        $dispositionBeanVide->setId($this->idDispoVide);
        $dispositionBeanVide->setNbPlace($salle->getCapaciteVide());
        $dispositionBeanVide->setDispositionDefaut(($this->idDispoVide === $idDispositionParDefaut) ? TRUE : FALSE);
        
        return array($dispositionBeanRectangle, $dispositionBeanConference, $dispositionBeanClasse, $dispositionBeanVide);
    }

}
