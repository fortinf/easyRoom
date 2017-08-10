<?php

namespace EasyRoom\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of UtilisateurRepository
 *
 * @author ffortin
 */
class UtilisateurRepository
        extends EntityRepository {

    /**
     * Liste tous les utilisateurs sauf celui qui corrrespond à l'id passé en paramètre
     * 
     * @param integer $idUtilisateur
     */
    public function getAllOthers($idUtilisateur) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('u')
                ->from('EasyRoomAppBundle:Utilisateur', 'u')
                ->where($qb->expr()->diff('u.id', ':idUtilisateur'))
                ->setParameter('idUtilisateur', $idUtilisateur);
        return $qb;
    }

}
