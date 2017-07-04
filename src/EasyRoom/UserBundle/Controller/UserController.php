<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of UserController
 *
 * @author ffortin
 */
class UserController extends Controller {
    
    public function listAction() {
        
        $usermanager = $this->get('fos_user.user_manager');
        $users = $usermanager->findUsers();
        
        return $this->render('EasyRoomUserBundle:User:list.html.twig', array(
                    'users' => $users
        ));
        
    }
    
    
    public function editAction($idUser) {
        
       
    }
}
