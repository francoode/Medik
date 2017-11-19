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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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

        $formItem = $this->createFormBuilder()
            ->add('item', EntityType::class,array(
                'class' => 'AppBundle:ItemTipoAnalisis'
            ))
            ->getForm();

        return $this->render('AppBundle:graficos:graficos.html.twig', array(
            'form' => $formItem->createView(),
        ));
    }

   /**
    * @Route("/result/{idPaciente}/{idItem}", name="resultGraficos",  options={"expose": true})
    * @Method("GET")
    */
   public function resultAction($idPaciente, $idItem)
   {
       $em = $this->getDoctrine()->getManager();

       $resultados = $em->getRepository('AppBundle:Analisis')->getAnalisisPaciente($idPaciente,$idItem);

        foreach ($resultados as &$res)
        {
            $res['fechaEntrega'] = $res['fechaEntrega']->format('d-m-y');
        }




       return new JsonResponse(['resultados' => $resultados]);

   }

}