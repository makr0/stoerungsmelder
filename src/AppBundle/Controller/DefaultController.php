<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Default controller. Hier finden alle Aktionen auf den Datensätzen statt
 *
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/aktuell", name="aktuelle_stoerungen")
     * @Template()
     */
    public function aktuellAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Stoerung')->findAll();

        return array(
        	'stoerungen'=>$entities
        );
    }
    /**
     * @Route("/beenden/{id}", name="stoerung_beenden")
     * @Template()
     */
    public function stoerungBeendenAction($id)
    {
        return array(
                // ...
        );
    }
    /**
     * @Route("/neu", name="stoerung_neu")
     * @Template()
     */
    public function stoerungNeuAction()
    {
        return array(
                // ...
        );
    }
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $anzahl_stoerungen =
            $em->getRepository('AppBundle:Stoerung')
               ->count_stoerungen_ohne_behebung();
        $anzahl_maschinen_ok =
            $em->getRepository('AppBundle:Stoerung')
               ->count_maschinen_ok();
        return array(
            "anzahl_stoerungen"=>$anzahl_stoerungen,
            "anzahl_maschinen_ok"=>$anzahl_maschinen_ok

        );
    }

}
