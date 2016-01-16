<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Stoerung;
use AppBundle\Entity\Maschine;
use AppBundle\Form\StoerungBeendenType;
use AppBundle\Form\StoerungType;

/**
 * Default controller. Hier finden alle Aktionen auf den Datensätzen statt
 *
 * @Route("/")
 */
class DefaultController extends Controller
{


    /**
     * @Route("/laufende/maschinen", name="laufende_maschinen")
     * @Template()
     */
    public function laufendeMaschinenAction()
    {
       $em = $this->getDoctrine()->getManager();

        $laufen = $em->getRepository('AppBundle:Stoerung')
                       ->findBy(array('behoben'=>true));

       $Abteilung =$em->getRepository('AppBundle:Abteilung')
       					->findAll();

       $maschinen = $em->getRepository('AppBundle:Maschine')
       					->findAll();


        return array(
        	'maschinen' => $maschinen,
        	'Abteilung' => $Abteilung,
          'laufen' => $laufen,
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
