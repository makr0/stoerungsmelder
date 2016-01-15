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
     * @Route("/laufende_maschinen/{$Abteilung}/{$maschineId}/{$seriennummer}", name="laufende_maschinen")
     * @Template()
     */
    public function laufendeMaschinenAction($Abteilung,$maschineId,$seriennummer)
    {
         $em = $this->getDoctrine()->getManager();
        $maschine = $em->getRepository('AppBundle:Maschine')->findAll($Abteilung);
        $entity = laufende_maschinen();
        $entity->setabteilung( $Abteilung );
        $entity->setMaschine( $maschine );
        $entity->setseriennummer( $seriennummer );
        $em->persist($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('laufende_maschinen')
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
