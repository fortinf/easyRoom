<?php

namespace EasyRoom\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller {

    public function indexAction()
    {
        return $this->render('EasyRoomAppBundle:Accueil:index.html.twig');
    }

}
