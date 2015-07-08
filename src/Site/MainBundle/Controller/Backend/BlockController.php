<?php

namespace Site\MainBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\MainBundle\Entity\Block;
use Site\MainBundle\Form\BlockType;

/**
 * Block controller.
 *
 */
class BlockController extends Controller
{

    /**
     * Lists all Block entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiteMainBundle:Block')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1) /*page number*/,
            10/*limit per page*/
        );

        return $this->render('SiteMainBundle:Backend/Block:index.html.twig', array(
            'entities' => $pagination,
        ));
    }
    /**
     * Creates a new Block entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Block();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $em->flush();

            return $this->redirect($this->generateUrl('backend_block_show', array('id' => $entity->getId())));
        }

        return $this->render('SiteMainBundle:Backend/Block:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Block entity.
     *
     * @param Block $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Block $entity)
    {
        $form = $this->createForm(new BlockType(), $entity, array(
            'action' => $this->generateUrl('backend_block_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Block entity.
     *
     */
    public function newAction()
    {
        $entity = new Block();
        $form   = $this->createCreateForm($entity);

        return $this->render('SiteMainBundle:Backend/Block:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Block entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Block')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.block.not_found'));
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteMainBundle:Backend/Block:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Block entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Block')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.block.not_found'));
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteMainBundle:Backend/Block:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Block entity.
    *
    * @param Block $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Block $entity)
    {
        $form = $this->createForm(new BlockType(), $entity, array(
            'action' => $this->generateUrl('backend_block_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.update'));

        return $form;
    }
    /**
     * Edits an existing Block entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Block')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.block.not_found'));
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('backend_block_edit', array('id' => $id)));
        }

        return $this->render('SiteMainBundle:Backend/Block:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Block entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiteMainBundle:Block')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException($this->get('translator')->trans('backend.block.not_found'));
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_block_index'));
    }

    /**
     * Creates a form to delete a Block entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_block_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'backend.delete',
                'translation_domain' => 'menu',
                'attr' => array(
                    'class' => 'btn-danger'
                )
            ))
            ->getForm()
        ;
    }
}
