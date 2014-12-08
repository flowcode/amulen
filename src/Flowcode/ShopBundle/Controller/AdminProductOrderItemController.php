<?php

namespace Flowcode\ShopBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Flowcode\ShopBundle\Entity\ProductOrderItem;
use Flowcode\ShopBundle\Form\ProductOrderItemType;

/**
 * ProductOrderItem controller.
 *
 * @Route("/admin/orderitem")
 */
class AdminProductOrderItemController extends Controller
{

    /**
     * Lists all ProductOrderItem entities.
     *
     * @Route("/", name="admin_orderitem")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FlowcodeShopBundle:ProductOrderItem')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ProductOrderItem entity.
     *
     * @Route("/", name="admin_orderitem_create")
     * @Method("POST")
     * @Template("FlowcodeShopBundle:ProductOrderItem:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ProductOrderItem();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_orderitem_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a ProductOrderItem entity.
    *
    * @param ProductOrderItem $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ProductOrderItem $entity)
    {
        $form = $this->createForm(new ProductOrderItemType(), $entity, array(
            'action' => $this->generateUrl('admin_orderitem_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProductOrderItem entity.
     *
     * @Route("/new", name="admin_orderitem_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ProductOrderItem();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ProductOrderItem entity.
     *
     * @Route("/{id}", name="admin_orderitem_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeShopBundle:ProductOrderItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductOrderItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ProductOrderItem entity.
     *
     * @Route("/{id}/edit", name="admin_orderitem_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeShopBundle:ProductOrderItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductOrderItem entity.');
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
    * Creates a form to edit a ProductOrderItem entity.
    *
    * @param ProductOrderItem $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductOrderItem $entity)
    {
        $form = $this->createForm(new ProductOrderItemType(), $entity, array(
            'action' => $this->generateUrl('admin_orderitem_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProductOrderItem entity.
     *
     * @Route("/{id}", name="admin_orderitem_update")
     * @Method("PUT")
     * @Template("FlowcodeShopBundle:ProductOrderItem:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeShopBundle:ProductOrderItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductOrderItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_orderitem_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ProductOrderItem entity.
     *
     * @Route("/{id}", name="admin_orderitem_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FlowcodeShopBundle:ProductOrderItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductOrderItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_orderitem'));
    }

    /**
     * Creates a form to delete a ProductOrderItem entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_orderitem_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
