<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of LoginController
 *
 * @author ffortin
 */
class LoginController
        extends Controller {

    public function indexAction() {
        return $this->render('EasyRoomAppBundle:Login:index.html.twig');
    }

    public function authentificationAction() {

        // Redirection vers la page d'accueil
        return $this->redirectToRoute('easy_room_app_accueil_index');
    }

}
