<?php

namespace Flowcode\ShopBundle\Controller;

use Flowcode\MediaBundle\Entity\Gallery;
use Flowcode\MediaBundle\Entity\GalleryItem;
use Flowcode\MediaBundle\Form\GalleryItemType;
use Flowcode\MediaBundle\Form\ImageGalleryType;
use Flowcode\ShopBundle\Entity\Product;
use Flowcode\ShopBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller.
 *
 * @Route("/admin/product")
 */
class AdminProductController extends Controller {

    /**
     * Lists all Product entities.
     *
     * @Route("/", name="admin_product")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FlowcodeShopBundle:Product')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Product entity.
     *
     * @Route("/", name="admin_product_create")
     * @Method("POST")
     * @Template("FlowcodeShopBundle:Product:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Product();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /* persist product */
            $em->persist($entity);

            if (is_null($entity->getMediaGallery())) {
                /* create media gallery */
                $mediaGallery = new Gallery();
                $mediaGallery->setName($entity->getName());
                $mediaGallery->setEnabled(true);
                $em->persist($mediaGallery);

                /* set media gallery */
                $entity->setMediaGallery($mediaGallery);
            }

            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', 'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('admin_product_show', array('id' => $entity->getId())));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'warning', 'Error'
            );
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Product entity.
     *
     * @param Product $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(Product $entity) {
        $form = $this->createForm(new ProductType(), $entity, array(
            'action' => $this->generateUrl('admin_product_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Product entity.
     *
     * @Route("/new", name="admin_product_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Product();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Product entity.
     *
     * @Route("/{id}", name="admin_product_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeShopBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     * @Route("/{id}/edit", name="admin_product_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeShopBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
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
     * Creates a form to edit a Product entity.
     *
     * @param Product $entity The entity
     *
     * @return Form The form
     */
    private function createEditForm(Product $entity) {
        $form = $this->createForm(new ProductType(), $entity, array(
            'action' => $this->generateUrl('admin_product_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Creates a form to edit a Product entity.
     *
     * @param Product $entity The entity
     *
     * @return Form The form
     */
    private function createEditGalleryForm(Gallery $entity) {
        $form = $this->createForm(new ImageGalleryType(), $entity, array(
            'action' => $this->generateUrl('admin_product_update_gallery', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Product entity.
     *
     * @Route("/{id}", name="admin_product_update")
     * @Method("PUT")
     * @Template("FlowcodeShopBundle:Product:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeShopBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_product_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Product entity.
     *
     * @Route("/{id}", name="admin_product_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FlowcodeShopBundle:Product')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Product entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_product'));
    }

    /**
     * Creates a form to delete a Product entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_product_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    /**
     * Displays a form to create a new Gallery entity.
     *
     * @Route("/{id}/addimage", name="admin_product_new_image")
     * @Method("GET")
     * @Template()
     */
    public function addimageAction($id) {
        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository('FlowcodeShopBundle:Product')->find($id);
        $gallery = $product->getMediaGallery();
        $entity = new GalleryItem();
        $entity->setGallery($gallery);
        $position = $gallery->getGalleryItems()->count() + 1;
        $entity->setPosition($position);

        $form = $this->createForm(new GalleryItemType(), $entity, array(
            'action' => $this->generateUrl('admin_galleryitem_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new GalleryItem entity.
     *
     * @Route("/", name="admin_product_create_image")
     * @Method("POST")
     * @Template("FlowcodeProductBundle:Product:addimage.html.twig")
     */
    public function createImageAction(Request $request) {
        $entity = new GalleryItem();
        $form = $this->createForm(new GalleryItemType(), $entity, array(
            'action' => $this->generateUrl('admin_galleryitem_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_product_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Edit media.
     *
     * @Route("/{id}/edit-media", name="admin_product_edit_media")
     * @Method("GET")
     * @Template()
     */
    public function editMediaAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeShopBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $form = $this->createEditGalleryForm($entity->getMediaGallery());

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Edits an existing Product Gallery entity.
     *
     * @Route("/gallery/{id}", name="admin_product_update_gallery")
     * @Method("PUT")
     * @Template("FlowcodeShopBundle:Product:edit.html.twig")
     */
    public function updateGalleryAction(Request $request, $id) {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('FlowcodeShopBundle:Product')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Product entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//        $editForm = $this->createEditForm($entity);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isValid()) {
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('admin_product_edit', array('id' => $id)));
//        }
//
//        return array(
//            'entity' => $entity,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        );
    }

}
