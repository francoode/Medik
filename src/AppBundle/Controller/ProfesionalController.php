<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Profesional;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ProfesionalType;
use Symfony\Component\Security\Core\User\UserInterface;


class ProfesionalController extends Controller
{
    public function listarAction()
    {
        $em = $this ->getDoctrine()->getManager();
        $prof = $em->getRepository('AppBundle:Profesional')->findAll();
        return $this->render ('AppBundle:Profesional:list.html.twig', array('prof' => $prof));

    }


    public function addAction()
    {
        $prof = new Profesional();
        $form = $this->createForm(new ProfesionalType(), $prof, array(
            'action'=> $this->generateUrl('profesionales_create'),
            'method' => 'POST'
        ));


        return $this->render('AppBundle:Profesional:add.html.twig', array('form' => $form->createView()));

    }

    public function createAction(Request $request)
    {

        $prof = new Profesional();
        $form = $this->createForm(new ProfesionalType(), $prof, array(
            'action'=> $this->generateUrl('profesionales_create'),
            'method' => 'POST'
        ));


        $form->handleRequest($request);



        if($form->isValid())
        {
            $prof->setActualizado(new \DateTime());
            $prof->setCreado(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($prof);
            $em->flush();
            return $this->redirectToRoute('prefesionales_listar');

        }
        return $this->render('AppBundle:Profesional:add.html.twig', array('form' => $form->createView()));
    }

    public function deleteAction(Profesional $prof)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($prof);
        $em->flush();

        return $this->redirectToRoute('prefesionales_listar');
    }

    public function editAction(Profesional $prof)
    {

        if(!$prof)
        {
         throw $this->createNotFoundException('No se encontró el profesional');
        }

        $form = $this->createForm(new ProfesionalType(), $prof, array(
            'action' => $this->generateUrl('profesional_update',array('id' => $prof->getId(),
                'method' => 'PUT'))));

        return $this->render('AppBundle:Profesional:edit.html.twig', array('prof' => $prof,
        'form' => $form->createView()));

    }

    /**
     * @Route("profesional/s/{id}", name="profesional_show")
     */
    public function showAction(Profesional $prof)
    {

        if(!$prof)
        {
            throw $this->createNotFoundException('No se encontró el profesional');
        }

        $form = $this->createForm(new ProfesionalType(), $prof);

        return $this->render('AppBundle:Profesional:show.html.twig', array('prof' => $prof,
            'form' => $form->createView()));

    }

    public function updateAction($id, Request $request)
    {


        $prof = $this->getDoctrine()
                    ->getRepository('AppBundle:Profesional')
                    ->find($id);



        $form = $this->createForm(new ProfesionalType(), $prof, array(
            'action' => $this->generateUrl('profesional_update',array('id' => $prof->getId(),
                'method' => 'PUT'))));

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $password = $form->get('password')->getData();
            if(!empty($password))
            {

                /*$encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($prof, $password);
                $prof->setPassword($encoded);*/
                $prof->setPassword($password);


            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('profesional_edit', array('id' => $prof->getId()));
        }

        return $this->redirectToRoute('profesional_edit', array('id' => $prof->getId()));


    }
}
