<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Service;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use EasyRoom\AppBundle\Bean\SearchSalleBean;
use EasyRoom\AppBundle\Entity\DispositionSalle;
use EasyRoom\AppBundle\Entity\Salle;

/**
 * Description of SalleService
 *
 * @author ffortin
 */
class SalleService {

    /**
     *
     * @var EntityManager 
     */
    private $em;
    private $dispositionService;
    private $equipementService;

    public function __construct(EntityManager $entityManager, DispositionService $dispositionSrv, EquipementService $equipementSrv) {
        $this->em = $entityManager;
        $this->dispositionService = $dispositionSrv;
        $this->equipementService = $equipementSrv;
    }

    /**
     * Fonction de création d'une salle
     * 
     * @param Salle $salle
     * @param array $dispositionBeans { integer idDisposition => DispositionBean dispositionBean }
     * @param array $idEquipements { integer idEquipement }
     * @return integer
     */
    public function create(Salle $salle, array $dispositionBeans, array $idEquipements) {
        // Dispositions
        foreach ($dispositionBeans as $id => $dispositionBean) {
            if (!is_null($id) && is_int($id)) {
                $disposition = $this->dispositionService->getById($id);

                if (!is_null($disposition)) {
                    $dispositionSalle = new DispositionSalle();
                    $dispositionSalle->setDisposition($disposition);
                    $dispositionSalle->setNbPlace($dispositionBean->getNbPlace());
                    $dispositionSalle->setDispositionDefaut($dispositionBean->getDispositionDefaut());
                    $salle->addDispositionSalle($dispositionSalle);
                    $this->em->persist($dispositionSalle);
                }
            }
        }

        // Equipements
        foreach ($idEquipements as $idEquipement) {
            if (!is_null($idEquipement) && is_int($idEquipement)) {

                $equipement = $this->equipementService->getById($idEquipement);

                if (!is_null($equipement)) {
                    $salle->addEquipement($equipement);
                }
            }
        }

        // Création de la salle
        $this->em->persist($salle);
        $this->em->flush();

        return $salle->getId();
    }

    /**
     * 
     * Fonction de mise à jour de la salle
     * 
     * @param integer $id
     * @param Salle $salle
     * @param array $dispositionBeans { integer idDisposition => DispositionBean dispositionBean }
     */
    public function update($id, Salle $salle, array $dispositionBeans) {

        $repository = $this->em->getRepository('EasyRoomAppBundle:Salle');
        $udpateSalle = $repository->find($id);

        if (!is_null($udpateSalle)) {
            // Informations de base
            $udpateSalle->setLibelle($salle->getLibelle());
            $udpateSalle->setDescription($salle->getDescription());
            $udpateSalle->setDisponible($salle->getDisponible());
            $udpateSalle->setHandicap($salle->getHandicap());
            $udpateSalle->setLumiereJour($salle->getLumiereJour());

            // Dispostions
            $arrayDispositionSalles = $udpateSalle->getDispositionSalles()->toArray();
            foreach ($arrayDispositionSalles as $dispositionSalle) {
                $idDisposition = $dispositionSalle->getDisposition()->getId();
                if (!is_null($dispositionBeans) && array_key_exists($idDisposition, $dispositionBeans)) {
                    $dispositionBean = $dispositionBeans[$idDisposition];
                    $dispositionSalle->setNbPlace($dispositionBean->getNbPlace());
                    $dispositionSalle->setDispositionDefaut($dispositionBean->getDispositionDefaut());
                }
            }

            // Modification de la salle
            $this->em->persist($udpateSalle);
            $this->em->flush();
        }
    }

    public function getById($id) {
        $repository = $this->em->getRepository('EasyRoomAppBundle:Salle');
        return $repository->find($id);
    }

    /**
     * Fonction qui retourne toutes les salles
     * 
     * @return mixed
     */
    public function getAll() {
        $repository = $this->em->getRepository('EasyRoomAppBundle:Salle');
        return $repository->findAll();
    }

    /**
     * Fonction de recherche de salles
     * 
     * @param SearchSalleBean $searchSalle
     */
    public function search(SearchSalleBean $searchSalle) {
        
    }

    /**
     * Fonction qui ajoute un équipement à une salle
     * 
     * @param integer $idSalle
     * @param integer $idEquipement
     */
    public function addEquipement($idSalle, $idEquipement) {
        if (!is_null($idSalle) && is_int($idSalle) && !is_null($idEquipement) && is_int($idEquipement)) {

            $salle = $this->getById($idSalle);
            $equipement = $this->equipementService->getById($idEquipement);

            if (!is_null($salle) && !is_null($equipement)) {
                $salle->addEquipement($equipement);
                $this->em->persist($salle);
                $this->em->flush();
            }
        }
    }

    /**
     * Fonction qui supprime un équipement d'une salle
     * 
     * @param integer $idSalle
     * @param integer $idEquipement
     */
    public function removeEquipement($idSalle, $idEquipement) {
        if (!is_null($idSalle) && is_int($idSalle) && !is_null($idEquipement) && is_int($idEquipement)) {

            $salle = $this->getById($idSalle);
            $equipement = $this->equipementService->getById($idEquipement);

            if (!is_null($salle) && !is_null($equipement)) {
                $salle->removeEquipement($equipement);
                $this->em->persist($salle);
                $this->em->flush();
            }
        }
    }

}
