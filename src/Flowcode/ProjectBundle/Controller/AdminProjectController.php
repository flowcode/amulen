<?php

namespace Flowcode\ProjectBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Flowcode\ProjectBundle\Entity\Project;
use Flowcode\ProjectBundle\Form\ProjectType;

/**
 * Project controller.
 *
 * @Route("/admin/project")
 */
class AdminProjectController extends Controller {

    /**
     * Dashboard of project module.
     *
     * @Route("/dashboard", name="admin_project_dashboard")
     * @Method("GET")
     * @Template()
     */
    public function dashboardAction() {
        return array();
    }

    /**
     * Lists all Project entities.
     *
     * @Route("/", name="admin_project_list")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FlowcodeProjectBundle:Project')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Project entity.
     *
     * @Route("/", name="admin_project_create")
     * @Method("POST")
     * @Template("FlowcodeProjectBundle:Project:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Project();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            if (is_null($entity->getMediaGallery())) {
                /* create media gallery */
                $mediaGallery = new \Flowcode\MediaBundle\Entity\Gallery();
                $mediaGallery->setName($entity->getName());
                $mediaGallery->setEnabled(true);
                $em->persist($mediaGallery);

                /* set media gallery */
                $entity->setMediaGallery($mediaGallery);
            }

            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('save_success')
            );

            return $this->redirect($this->generateUrl('admin_project_show', array('id' => $entity->getId())));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'warning', $this->get('translator')->trans('save_fail')
            );
        }


        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Project entity.
     *
     * @param Project $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Project $entity) {
        $em = $this->getDoctrine()->getManager();
        $rootName = $this->container->getParameter('flowcode_project.root_category');
        $root = $em->getRepository('FlowcodeClassificationBundle:Category')->findOneBy(array("name" => $rootName));
        $entities = $em->getRepository('FlowcodeClassificationBundle:Category')->getChildren($root);

        $form = $this->createForm(new ProjectType($entities), $entity, array(
            'action' => $this->generateUrl('admin_project_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Project entity.
     *
     * @Route("/new", name="admin_project_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Project();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Project entity.
     *
     * @Route("/{id}", name="admin_project_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeProjectBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     * @Route("/{id}/edit", name="admin_project_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeProjectBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
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
     * Creates a form to edit a Project entity.
     *
     * @param Project $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Project $entity) {
        $em = $this->getDoctrine()->getManager();
        $rootName = $this->container->getParameter('flowcode_project.root_category');
        $root = $em->getRepository('FlowcodeClassificationBundle:Category')->findOneBy(array("name" => $rootName));
        $entities = $em->getRepository('FlowcodeClassificationBundle:Category')->getChildren($root);
        $form = $this->createForm(new ProjectType($entities), $entity, array(
            'action' => $this->generateUrl('admin_project_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Project entity.
     *
     * @Route("/{id}", name="admin_project_update")
     * @Method("PUT")
     * @Template("FlowcodeProjectBundle:Project:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeProjectBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_project_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Gallery entity.
     *
     * @Route("/{id}/addimage", name="admin_project_new_image")
     * @Method("GET")
     * @Template()
     */
    public function addimageAction($id) {
        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository('FlowcodeProjectBundle:Project')->find($id);
        $gallery = $product->getMediaGallery();
        $entity = new \Flowcode\MediaBundle\Entity\GalleryItem();
        $entity->setGallery($gallery);
        $position = $gallery->getGalleryItems()->count() + 1;
        $entity->setPosition($position);

        $form = $this->createForm(new \Flowcode\MediaBundle\Form\GalleryItemType(), $entity, array(
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
     * Edit media.
     *
     * @Route("/{id}/edit-media", name="admin_project_edit_media")
     * @Method("GET")
     * @Template()
     */
    public function editMediaAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FlowcodeProjectBundle:Product')->find($id);

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
     * Deletes a Project entity.
     *
     * @Route("/{id}", name="admin_project_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FlowcodeProjectBundle:Project')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Project entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_project'));
    }

    /**
     * Creates a form to delete a Project entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_project_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
