<?php

namespace Flowcode\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Flowcode\UserBundle\Entity\UserGroup;
use Flowcode\UserBundle\Form\UserGroupType;

/**
 * UserGroup controller.
 *
 * @Route("/admin/usergroup")
 */
class UserGroupController extends Controller {

    /**
     * Lists all UserGroup entities.
     *
     * @Route("/", name="admin_usergroup")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FlowcodeUserBundle:UserGroup')->findAll();

        foreach ($entities as $entity)
        {
            $entity->setRoles($this->get('flowcode.security.roles')->traducirRoles($entity->getRoles()));
        }
        
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Displays a form to create a new UserGroup entity.
     *
     * @Route("/new", name="admin_usergroup_new")
     * @Method("GET")
     * @Template("FlowcodeUserBundle:UserGroup:new.html.twig")
     */
    public function newAction() {
        
        $viewBag = array();
        $entity = new UserGroup();
        $viewBag['form'] = $this->createCreateForm($entity)->createView();
        
        return $viewBag;
    }
    
    /**
     * Creates a new UserGroup entity.
     *
     * @Route("/", name="admin_usergroup_create")
     * @Method("POST")
     * @Template("FlowcodeUserBundle:UserGroup:new.html.twig")
     */
    public function createAction(Request $request) {
        
        $entity = new UserGroup();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirect($this->generateUrl('admin_usergroup_show', array('id' => $entity->getId())));
        }
        
        return array('form' => $form->createView());
    }
    
    /**
     * Finds and displays a UserGroup entity.
     *
     * @Route("/{id}", name="admin_usergroup_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeUserBundle:UserGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'roles' => $this->get('flowcode.security.roles')->traducirRoles($entity->getRoles()),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing UserGroup entity.
     *
     * @Route("/{id}/edit", name="admin_usergroup_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeUserBundle:UserGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserGroup entity.');
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
     * Creates a form to edit a UserGroup entity.
     *
     * @param UserGroup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UserGroup $entity) {
        $form = $this->createForm(new UserGroupType(), $entity, array(
            'action' => $this->generateUrl('admin_usergroup_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('roles', 
              'choice', 
               array(
                    'choices'   => $this->get('flowcode.security.roles')->getRoles(),
                    'multiple'  => true,
                    'label' => 'Roles'
                    )
             );
        $form->add('submit', 'submit', array('label' => 'Update'));
        
        return $form;
    }

    /**
     * Edits an existing UserGroup entity.
     *
     * @Route("/{id}", name="admin_usergroup_update")
     * @Method("PUT")
     * @Template("FlowcodeUserBundle:UserGroup:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeUserBundle:UserGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_usergroup_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a UserGroup entity.
     *
     * @Route("/{id}", name="admin_usergroup_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FlowcodeUserBundle:UserGroup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserGroup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_usergroup'));
    }

    /**
     * Creates a form to delete a UserGroup entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        
        $form = $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_usergroup_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm();
        return $form;
    }

    /**
     * Creates a form to create a UserGroup entity.
     *
     * @param UserGroup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserGroup $entity) 
    {
        $options = array ('action' => $this->generateUrl('admin_usergroup_create'), 
                          'method' => 'POST'
                         );

        $form = $this->createForm(new UserGroupType(), $entity, $options);
        $form->add('roles', 
              'choice', 
               array(
                    'choices'   => $this->get('flowcode.security.roles')->getRoles(),
                    'multiple'  => true,
                    'label' => 'Roles'
                    )
             );
            
        return $form;
    }
}
