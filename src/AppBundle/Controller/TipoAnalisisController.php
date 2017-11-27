<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TipoAnalisis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tipoanalisi controller.
 *
 * @Route("tipoanalisis")
 */
class TipoAnalisisController extends Controller
{
    /**
     * Lists all tipoAnalisi entities.
     *
     * @Route("/", name="tipoanalisis_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoAnalises = $em->getRepository('AppBundle:TipoAnalisis')->findAll();

        return $this->render('AppBundle:tipoanalisis:index.html.twig', array(
            'tipoAnalises' => $tipoAnalises,
        ));
    }

    /**
     * Creates a new tipoAnalisi entity.
     *
     * @Route("/new", name="tipoanalisis_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipoAnalisi = new Tipoanalisis();
        $form = $this->createForm('AppBundle\Form\TipoAnalisisType', $tipoAnalisi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoAnalisi);
            $em->flush();

            return $this->redirectToRoute('tipoanalisis_index');
        }

        return $this->render('AppBundle:tipoanalisis:new.html.twig', array(
            'tipoAnalisi' => $tipoAnalisi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tipoAnalisi entity.
     *
     * @Route("/{id}", name="tipoanalisis_show")
     * @Method("GET")
     */
    public function showAction(TipoAnalisis $tipoAnalisi)
    {
        $deleteForm = $this->createDeleteForm($tipoAnalisi);

        return $this->render('AppBundle:tipoanalisis:show.html.twig', array(
            'tipoAnalisi' => $tipoAnalisi,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tipoAnalisi entity.
     *
     * @Route("/{id}/edit", name="tipoanalisis_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TipoAnalisis $tipoAnalisi)
    {
        $deleteForm = $this->createDeleteForm($tipoAnalisi);
        $editForm = $this->createForm('AppBundle\Form\TipoAnalisisType', $tipoAnalisi);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipoanalisis_edit', array('id' => $tipoAnalisi->getId()));
        }

        return $this->render('AppBundle:tipoanalisis:edit.html.twig', array(
            'tipoAnalisi' => $tipoAnalisi,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tipoAnalisi entity.
     *
     * @Route("/{id}", name="tipoanalisis_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TipoAnalisis $tipoAnalisi)
    {
        $form = $this->createDeleteForm($tipoAnalisi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoAnalisi);
            $em->flush();
        }

        return $this->redirectToRoute('tipoanalisis_index');
    }

    /**
     * Creates a form to delete a tipoAnalisi entity.
     *
     * @param TipoAnalisis $tipoAnalisi The tipoAnalisi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoAnalisis $tipoAnalisi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipoanalisis_delete', array('id' => $tipoAnalisi->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
