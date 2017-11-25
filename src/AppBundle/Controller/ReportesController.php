<?php

namespace AppBundle\Controller;

use AppBundle\Form\ReporteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ReportesController
 * @package AppBundle\Controller
 * @Route("reporte")
 */
class ReportesController extends Controller
{
    /**
     * @Route("/paciente", name="pacienteReporte")
     */
    public function reporteClienteAction(Request $request)
    {
        $form = $this->createForm(new ReporteType(), array(
            'action' => $this->generateUrl('pacienteReporte'),
            'method' => 'POST'
        ));

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $fi = $data['fechaInicio'];
            $ff = $data['fechaFin'];
            $paciente = $data['paciente'];
            $analisisP = $this->getDoctrine()->getRepository('AppBundle:Analisis')->getAnalisisByPaciente($ff,$fi,$paciente);

            return $this->render('AppBundle:reportes:reporteCliente.html.twig', array(
                'form' => $form->createView(),
                'analisis' => $analisisP
            ));
        }

        return $this->render('AppBundle:reportes:reporteCliente.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
     * @Route("/cantidadTipo", name="cantidadTipo")
     */
    public function cantidadTipoAction(Request $request)
    {


        $form = $this->createForm(new ReporteType(), array(
            'action' => $this->generateUrl('cantidadTipo'),
            'method' => 'POST'
        ));

        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted())
        {
            $data = $form->getData();
            $fi = $data['fechaInicio'];
            $ff = $data['fechaFin'];
            $cantidad = $this->getDoctrine()->getRepository('AppBundle:Analisis')->getCantidadTipo($fi, $ff);
            $total = $this->getDoctrine()->getRepository('AppBundle:Analisis')->getTotalTipo($fi, $ff);
            $total = $total[0];

            return $this->render('AppBundle:reportes:reporteCantidadTipo.html.twig', array(
                'form' => $form->createView(),
                'cantidad' => $cantidad,
                'total' => $total
            ));
        }

        return $this->render('AppBundle:reportes:reporteCantidadTipo.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
