<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Analisis;
use AppBundle\Entity\ResultadoAnalisis;
use AppBundle\Entity\TipoAnalisis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ReporteType;

/**
 * Analisi controller.
 *
 * @Route("analisis")
 */
class AnalisisController extends Controller
{
    /**
     * Lists all analisi entities.
     *
     * @Route("/", name="analisis_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $obj = $this->get('security.token_storage')->getToken()->getUser();
        $idT = $obj->getId();
        $entityName = $em->getMetadataFactory()->getMetadataFor(get_class($obj))->getName();


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

            if($entityName == 'AppBundle\Entity\Paciente')
            {
                $analises = $em->getRepository('AppBundle:Analisis')->findBy(array('profesional' => $idT));
            }
            elseif ($entityName == 'AppBundle\Entity\Profesional' )
            {
                $analises = $em->getRepository('AppBundle:Analisis')->findBy(array('paciente' => $idT));
            }
            else{
                $analisis = $this->getDoctrine()->getRepository('AppBundle:Analisis')->getAnalisisbydate($fi, $ff);
            }



          

            return $this->render('AppBundle:analisis:index.html.twig', array(
                'form' => $form->createView(),
                'analises' => $analisis
            ));
        }






        if($entityName == 'AppBundle\Entity\Paciente')
        {
            $analises = $em->getRepository('AppBundle:Analisis')->findBy(array('profesional' => $idT));
        }
        elseif ($entityName == 'AppBundle\Entity\Profesional' )
        {
            $analises = $em->getRepository('AppBundle:Analisis')->findBy(array('paciente' => $idT));
        }
        else{
            $analises = $em->getRepository('AppBundle:Analisis')->findAll();
        }


        return $this->render('AppBundle:analisis:index.html.twig', array(
            'analises' => $analises,
            'form' => $form->createView()
        ));
    }



    /**
     * Creates a new analisi entity.
     *
     * @Route("/new", name="analisis_new")
     */
    public function newAction(Request $request)
    {
        $analisi = new Analisis();


        $form = $this->createForm('AppBundle\Form\AnalisisType', $analisi, array(
            'action' => $this->generateUrl('analisis_new'),
            'method' => 'POST',
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $collTipoAnalisis = $request->request->get('appbundle_analisis');
            $collTipoAnalisis = $collTipoAnalisis['tipoAnalisis'];

           $items = [];
            foreach ($collTipoAnalisis as $col)
            {
                $itemsCol = $em->getRepository('AppBundle:ItemTipoAnalisis')->findBy(array(
                    'tipoAnalisis' => $col[0]));
                if(!is_null($itemsCol))
                {
                    foreach ($itemsCol as $ic)
                    {
                        $items[] = $ic;
                    }
                }
            }

            foreach ($items as $it)
            {


            $resultadoAnalisis = new ResultadoAnalisis();
            $resultadoAnalisis->setAnalisis($analisi);
            $resultadoAnalisis->setItem($it);
            $resultadoAnalisis->setResultado(0);


            $analisi->addItem($resultadoAnalisis);

            

            }

            $analisi->setFechaCreado(new \DateTime());



            $em->persist($analisi);

            $em->flush();

            return $this->redirectToRoute('analisis_show', array('id' => $analisi->getId()));
        }

        return $this->render('AppBundle:analisis:new.html.twig', array(
            'analisi' => $analisi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a analisi entity.
     *
     * @Route("/{id}", name="analisis_show")
     * @Method("GET")
     */
    public function showAction(Analisis $analisi)
    {
       /* $deleteForm = $this->createDeleteForm($analisi);*/

        /*$form = $this->createForm('AppBundle\Form\AnalisisType', $analisi);*/
        $em = $this->getDoctrine()->getManager();

        $allItem = $em->getRepository('AppBundle:ResultadoAnalisis')->findBy(array('analisis' => $analisi));


        return $this->render('AppBundle:analisis:show.html.twig', array(
            'analisi' => $analisi,
            'allitem' => $allItem
           /* 'form' => $form->createView(),*/
        ));
    }

    /**
     * Displays a form to edit an existing analisi entity.
     *
     * @Route("/{id}/edit", name="analisis_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Analisis $analisi)
    {
        $deleteForm = $this->createDeleteForm($analisi);
        $paciente = $analisi->getPaciente();
        $fechaCreado = $analisi->getFechaCreado();



        $editForm = $this->createForm('AppBundle\Form\AnalisisType', $analisi);
        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $analisi->setFechaCreado($fechaCreado);
            $analisi->setPaciente($paciente);



            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('analisis_edit', array('id' => $analisi->getId()));
        }

        $em = $this->getDoctrine()->getManager();
        $allItem = $em->getRepository('AppBundle:ResultadoAnalisis')->findBy(array('analisis' => $analisi));

        return $this->render('AppBundle:analisis:edit.html.twig', array(
            'analisi' => $analisi,
            'allitem' => $allItem,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a analisi entity.
     *
     * @Route("/d/{id}", name="analisis_delete")
     */
    public function deleteAction( Analisis $analisi)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($analisi);
            $em->flush();


        return $this->redirectToRoute('analisis_index');
    }

    /**
     * Creates a form to delete a analisi entity.
     *
     * @param Analisis $analisi The analisi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Analisis $analisi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('analisis_delete', array('id' => $analisi->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
