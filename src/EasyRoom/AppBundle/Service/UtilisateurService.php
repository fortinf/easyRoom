<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Service;

use Doctrine\ORM\EntityManager;
use EasyRoom\AppBundle\Entity\Role;
use EasyRoom\AppBundle\Entity\Utilisateur;

/**
 * Description of UtilisateurService
 *
 * @author ffortin
 */
class UtilisateurService {

    private $em;
    private $roleService;

    public function __construct(EntityManager $entityManager, RoleService $roleSrv) {
        $this->em          = $entityManager;
        $this->roleService = $roleSrv;
    }

    /**
     * Fonction de création d'un utilisateur
     * 
     * @param Utilisateur $utilisateur
     * @param integer $idRole
     * @return integer
     */
    public function create(Utilisateur $utilisateur, $idRole) {
        if (!is_null($utilisateur) && $utilisateur instanceof Utilisateur && !is_null($idRole) && is_int($idRole)) {

            // Role
            $role = $this->roleService->getById($idRole);
            if (!is_null($role)) {
                $utilisateur->setRole($role);
            }

            $this->em->persist($utilisateur);
            $this->em->flush();
            return $utilisateur->getId();
        } else {
            return NULL;
        }
    }

    /**
     * Fonction de modification d'un utilisateur
     * 
     * @param integer $id
     * @param Utilisateur $utilisateur
     */
    public function update($id, Utilisateur $utilisateur) {

        if (!is_null($id) && is_int($id) && !is_null($utilisateur) && $utilisateur instanceof Utilisateur) {
            $repository        = $this->em->getRepository('EasyRoomAppBundle:Utilisateur');
            $updateUtilisateur = $repository->find($id);

            if (!is_null($updateUtilisateur)) {
                // Informations de base
                $updateUtilisateur->setNom($utilisateur->getNom());
                $updateUtilisateur->setPrenom($utilisateur->getPrenom());
                $updateUtilisateur->setMail($utilisateur->getMail());
                $updateUtilisateur->setMotDePasse($utilisateur->getMotDePasse());

                // Rôle utilisateur
                $updateUtilisateur->setRole($utilisateur->getRole());

                // Modification de l'utilisateur
                $this->em->persist($updateUtilisateur);
                $this->em->flush();
            }
        }
    }

    /**
     * Retourne un utilisateur depuis un id
     * 
     * @param integer $id
     * @return Utilisateur
     */
    public function getById($id) {
        if (!is_null($id) && is_int($id)) {
            $repository = $this->em->getRepository('EasyRoomAppBundle:Utilisateur');
            return $repository->find($id);
        } else {
            return NULL;
        }
    }

}
