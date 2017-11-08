<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        return $this->render('front.html.twig');
    }

    /**
     * @Route("/pdf", name="pdfreporte")
     */
    public function reportePdf()
    {
        $em = $this->getDoctrine()->getManager();

        $analisi = $em->getRepository('AppBundle:Analisis')->find(16);
        $allItem = $em->getRepository('AppBundle:ResultadoAnalisis')->findBy(array('analisis' => $analisi));



        $html = $this->renderView('AppBundle:analisis:j.html.twig', array(
            'analisi' => $analisi,
            'allitem' => $allItem
        ));


        $pdfGenerator = $this->get('spraed.pdf.generator');

        return new Response($pdfGenerator->generatePDF($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="out.pdf"',
                '/var/www/html/proyectof/app/Resources/css/bootstrap.css',
                '/var/www/html/proyectof/app/Resources/css/bootstrap-grid.css',
                '/var/www/html/proyectof/app/Resources/css/bootstrap-reboot.css',
                '/var/www/html/proyectof/app/Resources/css/bootstrap-theme.css',
                '/var/www/html/proyectof/app/Resources/css/main.css'

            )
        );
    }


}
