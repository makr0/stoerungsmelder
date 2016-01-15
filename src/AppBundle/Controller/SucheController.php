<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/suche")
 * @Template()
 */
class SucheController extends Controller
{
    /**
     * @Route("/",  name="suche_form")
     * @Template()
     */
    public function suchformAction()
    {
        return array(
                // hier steht nix, das Formular brauch keine daten
        );
    }
    /**
     * @Route("/ergebnis",  name="suche_ergebnis")
     * @Method("POST")
     * @Template()
     */
    public function suchergebnisAction(Request $request)
    {
        $code = $request->get('fehlercode');
        $em = $this->getDoctrine()->getManager();
        $ergebnisse = $em->getRepository('AppBundle:Stoerung')->findByFehlercode($code);
        return array(
            'fehlercode' =>$code,
            'ergebnisse'=> $ergebnisse
        );
    }
}
