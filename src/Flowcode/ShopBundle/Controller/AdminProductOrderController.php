<?php

namespace Flowcode\ShopBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Flowcode\ShopBundle\Entity\ProductOrder;
use Flowcode\ShopBundle\Form\ProductOrderType;

/**
 * ProductOrder controller.
 *
 * @Route("/admin/order")
 */
class AdminProductOrderController extends Controller
{

    /**
     * Lists all ProductOrder entities.
     *
     * @Route("/", name="admin_order")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FlowcodeShopBundle:ProductOrder')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ProductOrder entity.
     *
     * @Route("/", name="admin_order_create")
     * @Method("POST")
     * @Template("FlowcodeShopBundle:ProductOrder:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ProductOrder();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_order_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a ProductOrder entity.
    *
    * @param ProductOrder $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ProductOrder $entity)
    {
        $form = $this->createForm(new ProductOrderType(), $entity, array(
            'action' => $this->generateUrl('admin_order_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProductOrder entity.
     *
     * @Route("/new", name="admin_order_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ProductOrder();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ProductOrder entity.
     *
     * @Route("/{id}", name="admin_order_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeShopBundle:ProductOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductOrder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ProductOrder entity.
     *
     * @Route("/{id}/edit", name="admin_order_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeShopBundle:ProductOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductOrder entity.');
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
    * Creates a form to edit a ProductOrder entity.
    *
    * @param ProductOrder $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductOrder $entity)
    {
        $form = $this->createForm(new ProductOrderType(), $entity, array(
            'action' => $this->generateUrl('admin_order_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProductOrder entity.
     *
     * @Route("/{id}", name="admin_order_update")
     * @Method("PUT")
     * @Template("FlowcodeShopBundle:ProductOrder:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeShopBundle:ProductOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductOrder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_order_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ProductOrder entity.
     *
     * @Route("/{id}", name="admin_order_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FlowcodeShopBundle:ProductOrder')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductOrder entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_order'));
    }

    /**
     * Creates a form to delete a ProductOrder entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_order_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
