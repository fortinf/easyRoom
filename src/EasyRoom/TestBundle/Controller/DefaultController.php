<?php

namespace EasyRoom\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EasyRoomTestBundle:Default:index.html.twig');
    }
}
