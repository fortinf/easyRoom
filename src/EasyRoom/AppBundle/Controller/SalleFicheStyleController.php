<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of SalleFicheStyleController
 *
 * @author ffortin
 */
class SalleFicheStyleController
        extends Controller {

    public function buildStyleAction($idSalle) {
        
        $id = intval($idSalle);

        if (isset($id) && is_int($id)) {
            $salleService = $this->container->get('salle.service');
            $salle        = $salleService->getById($id);
        }
        
        //var_dump($salle);

        $response = new Response(
                $this->renderView('EasyRoomAppBundle:Salle:fiche_style.css.twig', array(
                    'photoPath' => $salle->getPhotoPath()
                )));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/css');
        
        //var_dump($response);
        
        return $response;
    }

}
