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
        $em = $this->getDoctrine()->getManager();

        $formItem = $this->createFormBuilder();
        $formItem->add('item', EntityType::class,array(
                'class' => 'AppBundle:ItemTipoAnalisis'
            ));

        $obj = $this->get('security.token_storage')->getToken()->getUser();
        $entityName = $em->getMetadataFactory()->getMetadataFor(get_class($obj))->getName();
        if($entityName == 'AppBundle\Entity\Administrador')
            {
            $formItem->add('paciente', EntityType::class, array(
                'class' => 'AppBundle:Paciente',
                'choice_label' => 'nombreanddni'
            ));
                }
        $formItem = $formItem->getForm();


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
            $res['resultado'] = floatval($res['resultado']);
        }

        $it = $em->getRepository('AppBundle:ItemTipoAnalisis')->find($idItem);
        $its = $it->getValoresReferencia();

        $pac = $em->getRepository('AppBundle:Paciente')->find($idPaciente);
        $edad = $pac->getEdad();

        $min = 0;
        $max = 0;

        foreach ($its as $s )
        {
            if($edad >= $s->getEdadMin() && $edad < $s->getEdadMax())
            {

                $min = $s->getValorMin();
                $max = $s->getValorMax();
            }
        }



       return new JsonResponse(['resultados' => $resultados, 'rMinimo' => $min, 'rMaximo' => $max]);

   }

}