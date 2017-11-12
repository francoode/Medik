<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

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



        $html = $this->renderView('AppBundle:pdfReporteAnalisis:j.html.twig', array(
            'analisi' => $analisi,
            'allitem' => $allItem,
        ));

        $head = $this->renderView('AppBundle:pdfReporteAnalisis:headpdf.html.twig',array(
                'analisi' => $analisi,
            )
        );

        $boot = $this->renderView('AppBundle:pdfReporteAnalisis:bootpdf.html.twig');




        /*
        Descarga PDF

                $response = new Response (
                    $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                    200,
                    array(
                        'Content-Type'          => '/home/franco/pdf/',
                        'Content-Disposition'   => 'attachment; filename="archivo.pdf"'
                    )
                );

        return $response;
        */

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html, array(
                'orientation' => 'landscape',
                'enable-javascript' => true,
                'header-html' => $head,
                'footer-html' => $boot,
                'javascript-delay' => 1000,
                'no-stop-slow-scripts' => true,
                'no-background' => false,
                'lowquality' => false,
                'encoding' => 'utf-8',
                'images' => true,
                'cookie' => array(),
                'page-height' =>  180,
                'page-width' => 140,
                'margin-top' => 15,
                'margin-bottom' => 15,
                'dpi' => 300,
                'image-dpi' => 300,
                'enable-external-links' => true,
                'enable-internal-links' => true
            )),
            'analisis.pdf'
        );




    }



}
