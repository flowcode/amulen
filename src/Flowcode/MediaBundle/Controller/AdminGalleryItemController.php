<?php

namespace Flowcode\MediaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Flowcode\MediaBundle\Entity\GalleryItem;
use Flowcode\MediaBundle\Form\GalleryItemType;

/**
 * GalleryItem controller.
 *
 * @Route("/admin/galleryitem")
 */
class AdminGalleryItemController extends Controller
{

    /**
     * Lists all GalleryItem entities.
     *
     * @Route("/", name="admin_galleryitem")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FlowcodeMediaBundle:GalleryItem')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new GalleryItem entity.
     *
     * @Route("/", name="admin_galleryitem_create")
     * @Method("POST")
     * @Template("FlowcodeMediaBundle:GalleryItem:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new GalleryItem();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_galleryitem_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a GalleryItem entity.
    *
    * @param GalleryItem $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(GalleryItem $entity)
    {
        $form = $this->createForm(new GalleryItemType(), $entity, array(
            'action' => $this->generateUrl('admin_galleryitem_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new GalleryItem entity.
     *
     * @Route("/new", name="admin_galleryitem_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new GalleryItem();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a GalleryItem entity.
     *
     * @Route("/{id}", name="admin_galleryitem_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeMediaBundle:GalleryItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GalleryItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing GalleryItem entity.
     *
     * @Route("/{id}/edit", name="admin_galleryitem_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeMediaBundle:GalleryItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GalleryItem entity.');
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
    * Creates a form to edit a GalleryItem entity.
    *
    * @param GalleryItem $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(GalleryItem $entity)
    {
        $form = $this->createForm(new GalleryItemType(), $entity, array(
            'action' => $this->generateUrl('admin_galleryitem_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing GalleryItem entity.
     *
     * @Route("/{id}", name="admin_galleryitem_update")
     * @Method("PUT")
     * @Template("FlowcodeMediaBundle:GalleryItem:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeMediaBundle:GalleryItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GalleryItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_galleryitem_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a GalleryItem entity.
     *
     * @Route("/{id}", name="admin_galleryitem_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FlowcodeMediaBundle:GalleryItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GalleryItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_galleryitem'));
    }

    /**
     * Creates a form to delete a GalleryItem entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_galleryitem_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
