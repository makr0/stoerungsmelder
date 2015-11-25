<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Abteilung;
use AppBundle\Form\AbteilungType;

/**
 * Abteilung controller.
 *
 * @Route("/abteilung")
 */
class AbteilungController extends Controller
{

    /**
     * Lists all Abteilung entities.
     *
     * @Route("/", name="abteilung")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Abteilung')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Abteilung entity.
     *
     * @Route("/", name="abteilung_create")
     * @Method("POST")
     * @Template("AppBundle:Abteilung:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Abteilung();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('abteilung_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Abteilung entity.
     *
     * @param Abteilung $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Abteilung $entity)
    {
        $form = $this->createForm(new AbteilungType(), $entity, array(
            'action' => $this->generateUrl('abteilung_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Abteilung entity.
     *
     * @Route("/new", name="abteilung_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Abteilung();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Abteilung entity.
     *
     * @Route("/{id}", name="abteilung_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Abteilung')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Abteilung entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Abteilung entity.
     *
     * @Route("/{id}/edit", name="abteilung_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Abteilung')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Abteilung entity.');
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
    * Creates a form to edit a Abteilung entity.
    *
    * @param Abteilung $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Abteilung $entity)
    {
        $form = $this->createForm(new AbteilungType(), $entity, array(
            'action' => $this->generateUrl('abteilung_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Abteilung entity.
     *
     * @Route("/{id}", name="abteilung_update")
     * @Method("PUT")
     * @Template("AppBundle:Abteilung:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Abteilung')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Abteilung entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('abteilung_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Abteilung entity.
     *
     * @Route("/{id}", name="abteilung_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Abteilung')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Abteilung entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('abteilung'));
    }

    /**
     * Creates a form to delete a Abteilung entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('abteilung_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
