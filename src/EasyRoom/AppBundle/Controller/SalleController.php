<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of SalleController
 *
 * @author ffortin
 */
class SalleController extends Controller {
    
    public function creationAction()
    {
    	
        return $this->render('EasyRoomAppBundle:Salle:creation.html.twig');
        
    }

    public function searchAction()
    {
        return $this->render('EasyRoomAppBundle:Salle:search_salle.html.twig');
    }
    
    public function affichageAction()
    {
    	return $this->render('EasyRoomAppBundle:Salle:fiche.html.twig');
    }
}
