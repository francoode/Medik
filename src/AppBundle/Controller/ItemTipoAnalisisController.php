<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ItemTipoAnalisis;
use AppBundle\Entity\ValoresReferencia;
use AppBundle\Form\ValoresReferenciaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Itemtipoanalisi controller.
 *
 * @Route("itemtipoanalisis")
 */
class ItemTipoAnalisisController extends Controller
{
    /**
     * Lists all itemTipoAnalisi entities.
     *
     * @Route("/", name="itemtipoanalisis_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $itemTipoAnalises = $em->getRepository('AppBundle:ItemTipoAnalisis')->findAll();

        return $this->render('AppBundle:itemtipoanalisis:index.html.twig', array(
            'itemTipoAnalises' => $itemTipoAnalises,
        ));
    }

    /**
     * Creates a new itemTipoAnalisi entity.
     *
     * @Route("/new", name="itemtipoanalisis_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $itemTipoAnalisi = new Itemtipoanalisis();
        $form = $this->createForm('AppBundle\Form\ItemTipoAnalisisType', $itemTipoAnalisi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($itemTipoAnalisi);
            $em->flush();

            return $this->redirectToRoute('itemtipoanalisis_new', array('id' => $itemTipoAnalisi->getId()));
        }

        return $this->render('AppBundle:itemtipoanalisis:new.html.twig', array(
            'itemTipoAnalisi' => $itemTipoAnalisi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a itemTipoAnalisi entity.
     *
     * @Route("/{id}", name="itemtipoanalisis_show")
     * @Method("GET")
     */
    public function showAction(ItemTipoAnalisis $itemTipoAnalisi)
    {
        $deleteForm = $this->createDeleteForm($itemTipoAnalisi);

        return $this->render('AppBundle:itemtipoanalisis:show.html.twig', array(
            'itemTipoAnalisi' => $itemTipoAnalisi,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing itemTipoAnalisi entity.
     *
     * @Route("/{id}/edit", name="itemtipoanalisis_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ItemTipoAnalisis $itemTipoAnalisi)
    {

        $deleteForm = $this->createDeleteForm($itemTipoAnalisi);
        $editForm = $this->createForm('AppBundle\Form\ItemTipoAnalisisType', $itemTipoAnalisi);
        $editForm->handleRequest($request);



        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('itemtipoanalisis_index');
        }

        return $this->render('AppBundle:itemtipoanalisis:edit.html.twig', array(
            'itemTipoAnalisi' => $itemTipoAnalisi,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/delete", name="itemtipoanalisis_delete")
     *
     */

    public function deleteAction(ItemTipoAnalisis $id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();

        return $this->redirectToRoute('itemtipoanalisis_index');
    }

    /**
     * Creates a form to delete a itemTipoAnalisi entity.
     *
     * @param ItemTipoAnalisis $itemTipoAnalisi The itemTipoAnalisi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ItemTipoAnalisis $itemTipoAnalisi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('itemtipoanalisis_delete', array('id' => $itemTipoAnalisi->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
