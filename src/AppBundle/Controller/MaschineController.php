<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Maschine;
use AppBundle\Form\MaschineType;

/**
 * Maschine controller.
 *
 * @Route("/maschine")
 */
class MaschineController extends Controller
{

    /**
     * Lists all Maschine entities.
     *
     * @Route("/", name="maschine")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Maschine')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Maschine entity.
     *
     * @Route("/", name="maschine_create")
     * @Method("POST")
     * @Template("AppBundle:Maschine:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Maschine();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('maschine_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Maschine entity.
     *
     * @param Maschine $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Maschine $entity)
    {
        $form = $this->createForm(new MaschineType(), $entity, array(
            'action' => $this->generateUrl('maschine_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Anlegen'));

        return $form;
    }

    /**
     * Displays a form to create a new Maschine entity.
     *
     * @Route("/new", name="maschine_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Maschine();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Maschine entity.
     *
     * @Route("/{id}", name="maschine_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Maschine')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Maschine entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Maschine entity.
     *
     * @Route("/{id}/edit", name="maschine_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Maschine')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Maschine entity.');
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
    * Creates a form to edit a Maschine entity.
    *
    * @param Maschine $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Maschine $entity)
    {
        $form = $this->createForm(new MaschineType(), $entity, array(
            'action' => $this->generateUrl('maschine_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Aktualisieren'));

        return $form;
    }
    /**
     * Edits an existing Maschine entity.
     *
     * @Route("/{id}", name="maschine_update")
     * @Method("PUT")
     * @Template("AppBundle:Maschine:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Maschine')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Maschine entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('maschine_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Maschine entity.
     *
     * @Route("/{id}", name="maschine_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Maschine')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Maschine entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('maschine'));
    }

    /**
     * Creates a form to delete a Maschine entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('maschine_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Löschen'))
            ->getForm()
        ;
    }
}
