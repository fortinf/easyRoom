<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of EquipementController
 *
 * @author ffortin
 */
class EquipementController extends Controller {
    
    public function indexAction()
    {
        return $this->render('EasyRoomAppBundle:Equipement:index.html.twig');
    }
    
}
