<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Stoerung;
use AppBundle\Form\StoerungType;

/**
 * Stoerung controller.
 *
 * @Route("/stoerung")
 */
class StoerungController extends Controller
{

    /**
     * Lists all Stoerung entities.
     *
     * @Route("/", name="stoerung")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Stoerung')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Stoerung entity.
     *
     * @Route("/", name="stoerung_create")
     * @Method("POST")
     * @Template("AppBundle:Stoerung:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Stoerung();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stoerung_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Stoerung entity.
     *
     * @param Stoerung $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Stoerung $entity)
    {
        $form = $this->createForm(new StoerungType(), $entity, array(
            'action' => $this->generateUrl('stoerung_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Anlegen'));

        return $form;
    }

    /**
     * Displays a form to create a new Stoerung entity.
     *
     * @Route("/new", name="stoerung_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Stoerung();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Stoerung entity.
     *
     * @Route("/{id}", name="stoerung_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Stoerung')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stoerung entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Stoerung entity.
     *
     * @Route("/{id}/edit", name="stoerung_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Stoerung')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stoerung entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Stoerung entity.
    *
    * @param Stoerung $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Stoerung $entity)
    {
        $form = $this->createForm(new StoerungType(), $entity, array(
            'action' => $this->generateUrl('stoerung_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Aktualisieren'));

        return $form;
    }
    /**
     * Edits an existing Stoerung entity.
     *
     * @Route("/{id}", name="stoerung_update")
     * @Method("PUT")
     * @Template("AppBundle:Stoerung:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Stoerung')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stoerung entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('stoerung_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Stoerung entity.
     *
     * @Route("/{id}", name="stoerung_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Stoerung')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Stoerung entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stoerung'));
    }

    /**
     * Creates a form to delete a Stoerung entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stoerung_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Löschen'))
            ->getForm()
        ;
    }
}
