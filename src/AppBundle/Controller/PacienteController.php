<?php
/**
 * Created by PhpStorm.
 * User: franco
 * Date: 21/09/17
 * Time: 18:06
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Paciente;
use AppBundle\Form\PacienteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ProfesionalType;
use Symfony\Component\Security\Core\User\UserInterface;


class PacienteController extends Controller
{
    /**
     * @Route("/paciente/", name="paciente_list")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository('AppBundle:Paciente')->findAll();
        return $this->render ('AppBundle:Paciente:index.html.twig', array('p' => $p));

    }

    /**
     * @Route ("/paciente/new", name="paciente_create")
     */
    public function createAction()
    {
        $p = new Paciente();
        $form = $this->createForm(new PacienteType(), $p, array(
            'action'=> $this->generateUrl('paciente_add'),
            'method' => 'POST'
        ));

        return $this->render('AppBundle:Paciente:add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/paciente/add", name="paciente_add")
     */
    public function addAction(Request $request)
    {
        $p = new Paciente();
        $form = $this->createForm(new PacienteType(), $p, array(
            'action'=> $this->generateUrl('paciente_add'),
            'method' => 'POST'
        ));

        $form->handleRequest($request);



        if($form->isValid() && $form->isSubmitted())
        {
            $p->setFechaActualizado(new \DateTime());
            $p->setFechaRegistro(new \DateTime());
            $p->setEdad();
            $em = $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush();
            return $this->redirectToRoute('paciente_list');
        }

        return $this->redirectToRoute('paciente_list');
    }

    /**
     * @Route("/paciente/d/{id}", name="paciente_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository('AppBundle:Paciente')->find($id);

        $em->remove($p);
        $em->flush();

        return $this->redirectToRoute('paciente_list');
    }

    /**
     * @Route("/paciente/s/{id}", name="paciente_show")
     */
    public function showAction(Paciente $pac)
    {

        if(!$pac)
        {
            throw $this->createNotFoundException('No se encontró el profesional');
        }

        $form = $this->createForm(new PacienteType(), $pac);

        return $this->render('AppBundle:Paciente:show.html.twig', array('pac' => $pac,
            'form' => $form->createView()));
    }

    /**
     * @Route("paciente/u/{id}", name="paciente_update")
     */
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository('AppBundle:Paciente')->findOneBy(array('id'=>$id));

        $form = $this->createForm(new PacienteType(), $p, array(
            'action' => $this->generateUrl('paciente_update',array('id' => $p->getId(),
                'method' => 'PUT'))));

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $p->setEdad();

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('paciente_edit', array('id' => $p->getId()));
        }

        return $this->redirectToRoute('paciente_edit', array('id' => $p->getId()));

    }

    /**
     * @Route("paciente/e/{id}", name="paciente_edit")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository('AppBundle:Paciente')->findOneBy(array('id'=>$id));

        $form = $this->createForm(new PacienteType(), $p, array(
            'action' => $this->generateUrl('paciente_update',array('id' => $p->getId(),
                'method' => 'PUT'))));

        return $this->render('AppBundle:Paciente:edit.html.twig', array('form' => $form->createView(),
            'p' => $p));
    }


}