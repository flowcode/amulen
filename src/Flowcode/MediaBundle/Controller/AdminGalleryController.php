<?php

namespace Flowcode\MediaBundle\Controller;

use Flowcode\MediaBundle\Entity\Gallery;
use Flowcode\MediaBundle\Entity\GalleryItem;
use Flowcode\MediaBundle\Form\GalleryItemType;
use Flowcode\MediaBundle\Form\GalleryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Gallery controller.
 *
 * @Route("/admin/gallery")
 */
class AdminGalleryController extends Controller {

    /**
     * Lists all Gallery entities.
     *
     * @Route("/", name="admin_gallery")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FlowcodeMediaBundle:Gallery')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Gallery items.
     *
     * @Route("/{id}/items", name="admin_gallery_items")
     * @Method("GET")
     * @Template()
     */
    public function itemsAction($id) {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('FlowcodeMediaBundle:Gallery')->find($id);

        if (!$gallery) {
            throw $this->createNotFoundException('Unable to find Gallery entity.');
        }

        return array(
            'gallery' => $gallery,
            'items' => $gallery->getGalleryItems(),
        );
    }

    /**
     * Creates a new Gallery entity.
     *
     * @Route("/", name="admin_gallery_create")
     * @Method("POST")
     * @Template("FlowcodeMediaBundle:Gallery:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Gallery();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gallery_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Gallery entity.
     *
     * @param Gallery $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(Gallery $entity) {
        $form = $this->createForm(new GalleryType(), $entity, array(
            'action' => $this->generateUrl('admin_gallery_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Gallery entity.
     *
     * @Route("/new", name="admin_gallery_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Gallery();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Gallery entity.
     *
     * @Route("/{id}", name="admin_gallery_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeMediaBundle:Gallery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gallery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Gallery entity.
     *
     * @Route("/{id}/edit", name="admin_gallery_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeMediaBundle:Gallery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gallery entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Gallery entity.
     *
     * @param Gallery $entity The entity
     *
     * @return Form The form
     */
    private function createEditForm(Gallery $entity) {
        $form = $this->createForm(new GalleryType(), $entity, array(
            'action' => $this->generateUrl('admin_gallery_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Gallery entity.
     *
     * @Route("/{id}", name="admin_gallery_update")
     * @Method("PUT")
     * @Template("FlowcodeMediaBundle:Gallery:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeMediaBundle:Gallery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gallery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gallery_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Gallery entity.
     *
     * @Route("/{id}", name="admin_gallery_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FlowcodeMediaBundle:Gallery')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Gallery entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_gallery'));
    }

    /**
     * Creates a form to delete a Gallery entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_gallery_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    /**
     * Displays a form to create a new Gallery entity.
     *
     * @Route("/{id}/item/remove", name="admin_gallery_item_remove")
     */
    public function removeitemAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $galleryItem = $em->getRepository('FlowcodeMediaBundle:GalleryItem')->find($id);

        $gallery = $galleryItem->getGallery();

        $em->remove($galleryItem);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_gallery_items', array("id" => $gallery->getId())));
    }

    /**
     * Displays a form to create a new Gallery entity.
     *
     * @Route("/{id}/item/new", name="admin_gallery_item_new")
     * @Method("GET")
     * @Template()
     */
    public function additemAction($id) {
        $em = $this->getDoctrine()->getManager();

        $gallery = $em->getRepository('FlowcodeMediaBundle:Gallery')->find($id);
        $entity = new GalleryItem();
        $entity->setGallery($gallery);
        $position = $gallery->getGalleryItems()->count() + 1;
        $entity->setPosition($position);

        $form = $this->createForm(new GalleryItemType(), $entity, array(
            'action' => $this->generateUrl('admin_gallery_item_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Media entity.
     *
     * @Route("/item", name="admin_gallery_item_create")
     * @Method("POST")
     * @Template("FlowcodeMediaBundle:Gallery:additem.html.twig")
     */
    public function createMediaAction(Request $request) {
        $entity = new \Flowcode\MediaBundle\Entity\GalleryItem();

        $form = $this->createForm(new GalleryItemType(), $entity, array(
            'action' => $this->generateUrl('admin_gallery_item_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gallery_items', array('id' => $entity->getGallery()->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing GalleryItem entity.
     *
     * @Route("/item/{id}/edit", name="admin_gallery_item_edit")
     * @Method("GET")
     * @Template()
     */
    public function editItemAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeMediaBundle:GalleryItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GalleryItem entity.');
        }

        $editForm = $this->createForm(new GalleryItemType(), $entity, array(
            'action' => $this->generateUrl('admin_gallery_item_update', array("id" => $entity->getId())),
            'method' => 'PUT',
        ));
        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing GalleryItem entity.
     *
     * @Route("/item/{id}", name="admin_gallery_item_update")
     * @Method("PUT")
     * @Template("FlowcodeMediaBundle:AdminGallery:editItem.html.twig")
     */
    public function updateItemAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeMediaBundle:GalleryItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GalleryItem entity.');
        }

        $editForm = $this->createForm(new GalleryItemType(), $entity, array(
            'action' => $this->generateUrl('admin_gallery_item_update', array("id" => $entity->getId())),
            'method' => 'PUT',
        ));
        $editForm->add('submit', 'submit', array('label' => 'Update'));
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gallery_items', array('id' => $entity->getGallery()->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        );
    }

}
