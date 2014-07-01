<?php

namespace Flowcode\PageBundle\Controller;

use Flowcode\PageBundle\Entity\Block;
use Flowcode\PageBundle\Entity\Page;
use Flowcode\PageBundle\Form\BlockType;
use Flowcode\PageBundle\Form\PageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Page controller.
 *
 * @Route("/admin/page")
 */
class AdminPageController extends Controller {

    /**
     * Lists all Page entities.
     *
     * @Route("/", name="admin_page")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {

        $page = $request->get("page", 1);
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT p FROM FlowcodePageBundle:Page p";
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($query, $this->get('request')->query->get('page', $page));

        return array(
            'pagination' => $pagination,
        );
    }

    /**
     * Creates a new Page entity.
     *
     * @Route("/", name="admin_page_create")
     * @Method("POST")
     * @Template("FlowcodePageBundle:Page:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Page();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_page_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Page entity.
     *
     * @param Page $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(Page $entity) {
        $form = $this->createForm(new PageType(), $entity, array(
            'action' => $this->generateUrl('admin_page_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Page entity.
     *
     * @Route("/new", name="admin_page_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Page();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Page entity.
     *
     * @Route("/{id}", name="admin_page_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('FlowcodePageBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Page entity.
     *
     * @Route("/{id}/edit", name="admin_page_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodePageBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
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
     * Creates a form to edit a Page entity.
     *
     * @param Page $entity The entity
     *
     * @return Form The form
     */
    private function createEditForm(Page $entity) {
        $form = $this->createForm(new PageType(), $entity, array(
            'action' => $this->generateUrl('admin_page_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Page entity.
     *
     * @Route("/{id}", name="admin_page_update")
     * @Method("PUT")
     * @Template("FlowcodePageBundle:Page:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodePageBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_page_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Page entity.
     *
     * @Route("/{id}", name="admin_page_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FlowcodePageBundle:Page')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Page entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_page'));
    }

    /**
     * Creates a form to delete a Page entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_page_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    /**
     * Finds and displays a Block entity.
     *
     * @Route("/page/{page_id}/blocks", name="admin_page_blocks")
     * @Method("GET")
     * @Template()
     */
    public function blocksAction($page_id) {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FlowcodePageBundle:Block')->findBy(array("page" => $page_id));
        $page = $em->getRepository('FlowcodePageBundle:Page')->find($page_id);

        return array(
            'page' => $page,
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Block entity.
     *
     * @Route("/block/{type}", name="admin_page_block_create")
     * @Method("POST")
     * @Template("FlowcodePageBundle:AdminPage:new_block.html.twig")
     */
    public function createBlockAction(Request $request, $type) {
        $entity = new Block();
        $entity->setType($type);
        $form = $this->createBlockCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

//            $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');
//            $repository->translate($entity, 'content', 'en', $entity->getContent());

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_page_block_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Block entity.
     *
     * @param Block $entity The entity
     *
     * @return Form The form
     */
    private function createBlockCreateForm(Block $entity) {

        $types = $this->container->getParameter('flowcode_page.block_types');
        $class = $types[$entity->getType()]["class_type"];

        $form = $this->createForm(new $class(), $entity, array(
            'action' => $this->generateUrl('admin_page_block_create', array("type" => $entity->getType())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Block entity.
     *
     * @Route("/{page_id}/block/{type}/new", name="admin_page_block_new")
     * @Method("GET")
     * @Template("FlowcodePageBundle:AdminPage:new_block.html.twig")
     */
    public function newBlockAction($page_id, $type) {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('FlowcodePageBundle:Page')->find($page_id);

        $entity = new Block();
        $entity->setType($type);
        $entity->setPage($page);
        $form = $this->createBlockCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Block entity.
     *
     * @Route("/{id}", name="admin_page_block_show")
     * @Method("GET")
     * @Template()
     */
    public function showBlockAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodePageBundle:Block')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Block entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Block entity.
     *
     * @Route("/{id}/edit", name="admin_page_block_edit")
     * @Method("GET")
     * @Template()
     */
    public function editBlockAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodePageBundle:Block')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Block entity.');
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
     * Creates a form to edit a Block entity.
     *
     * @param Block $entity The entity
     *
     * @return Form The form
     */
    private function createBlockEditForm(Block $entity) {
        $form = $this->createForm(new BlockType(), $entity, array(
            'action' => $this->generateUrl('block_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Block entity.
     *
     * @Route("/{id}", name="admin_page_block_update")
     * @Method("PUT")
     * @Template("FlowcodePageBundle:Block:edit.html.twig")
     */
    public function updateBlockAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodePageBundle:Block')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Block entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('block_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Block entity.
     *
     * @Route("/{id}", name="admin_page_block_delete")
     * @Method("DELETE")
     */
    public function deleteBlockAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FlowcodePageBundle:Block')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Block entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('block'));
    }

    /**
     * Creates a form to delete a Block entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createBlockDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('block_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
