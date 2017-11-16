<?php
/**
 * Created by PhpStorm.
 * User: franco
 * Date: 15/11/17
 * Time: 21:57
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;


class GraficoController extends Controller
{

    /**
     * @Route("/graficos", name="graficos", options={"expose": true})
     */
    public function graficosAction()
    {

        return $this->render('AppBundle:graficos:graficos.html.twig');
    }

   /**
    * @Route("/result", name="resultGraficos",  options={"expose": true})
    * @Method("GET")
    */
   public function resultAction()
   {
       $em = $this->getDoctrine()->getManager();
       $resultados = $em->getRepository('AppBundle:Analisis')->getAnalisisPaciente(2,2);


       foreach ($resultados as $res)
       {
           $res['fechaEntrega']->format('Y-m-d');
       }

       return new JsonResponse(['resultados' => $resultados]);

   }

}