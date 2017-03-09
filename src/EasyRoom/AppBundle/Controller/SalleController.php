<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Controller;

use EasyRoom\AppBundle\Entity\DispositionSalle;
use EasyRoom\AppBundle\Entity\Equipement;
use EasyRoom\AppBundle\Entity\Salle;
use EasyRoom\AppBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of SalleController
 *
 * @author ffortin
 */
class SalleController extends Controller {
    
    public function indexAction()
    {
        
        // SALLE
        $salleService = $this->container->get('salle.service');

        $salle = new Salle();
        $salle->setLibelle('Salle test 2');
        $salle->setDescription('Ceci est une salle de test 2');
        $salle->setDisponible(FALSE);
        $salle->setHandicap(TRUE);
        $salle->setLumiereJour(TRUE);

        $dispositionSalle1 = new DispositionSalle();
        $dispositionSalle1->setNbPlace(15);
        $dispositionSalle1->setDispositionDefaut(FALSE);

        $dispositionSalle2 = new DispositionSalle();
        $dispositionSalle2->setNbPlace(40);
        $dispositionSalle2->setDispositionDefaut(TRUE);

        $tabDispositionSalles = array(
            '1' => $dispositionSalle1,
            '2' => $dispositionSalle2
        );

        $salleService->update(2, $salle, $tabDispositionSalles);
        
        
        // UTILISATEUR
        $roleService = $this->container->get('role.service');
        $role = $roleService->getRoleById(2);
        
        $administrateur = new Utilisateur();
        $administrateur->setNom('Paul');
        $administrateur->setPrenom('O\'Connor');
        $administrateur->setMail('olivier.oconnor@yopmail.com');
        $administrateur->setMotDePasse('xhg_p^rtu)');
        $administrateur->setRole($role);
        
        $utilisateurService = $this->container->get('utilisateur.service');
        $utilisateurService->update(1, $administrateur);
        
        // EQUIPEMENT
        $typeEquipementService = $this->container->get('typeequipement.service');
        $typeEquipementVideoProjecteur = $typeEquipementService->getTypeEquipementById(3);
        $typeEquipementTelephone = $typeEquipementService->getTypeEquipementById(2);
        
        
        $equipementService = $this->container->get('equipement.service');
        $equipement1 = new Equipement();
        $equipement1->setLibelle('Viewsonic PRO8520WL');
        $equipement1->setDescription("2 entrées VGA, 3D ready, Correction de trapèze horizontal, Lens Shift, MHL, orateur intégré >=8  Watts, Télécommande");
        $equipement1->setReference('VID-PRO_001');
        $equipement1->setMobilite(TRUE);
        $equipement1->setDisponible(TRUE);
        $equipement1->setTypeEquipement($typeEquipementVideoProjecteur);
        $equipementService->create($equipement1);
        
        $equipement2 = new Equipement();
        $equipement2->setLibelle('Konftel 250');
        $equipement2->setDescription("Conçu pour des locaux de 30 à 70 m², le téléphone de conférence Konftel "
                . "250 est adapté pour des réunions rassemblant jusque 10 personnes. Doté d'un écran LCD rétro-éclairé "
                . "et d'un clavier de numérotation, ce téléphone de conférence intègre les principales fonctions d'un "
                . "téléphone comme un répertoire d'une capacité de stockage de 50 numéros.");
        $equipement2->setReference('TEL_001');
        $equipement2->setMobilite(FALSE);
        $equipement2->setDisponible(TRUE);
        $equipement2->setTypeEquipement($typeEquipementTelephone);
        $equipementService->create($equipement2);
        
        return $this->render('EasyRoomAppBundle:Salle:index.html.twig');
    }
    
}
