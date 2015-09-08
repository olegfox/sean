<?php

namespace Site\MainBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\MainBundle\Entity\OurWork;
use Site\MainBundle\Form\OurWorkType;

/**
 * OurWork controller.
 *
 */
class OurWorkController extends Controller
{

    /**
     * Lists all OurWork entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiteMainBundle:OurWork')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1) /*page number*/,
            10/*limit per page*/
        );

        return $this->render('SiteMainBundle:Backend/OurWork:index.html.twig', array(
            'entities' => $pagination,
        ));
    }
    /**
     * Creates a new OurWork entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new OurWork();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
//          Элементы работ
            foreach ($entity->getElements() as $element) {
                $element->setOurWork($entity);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $em->flush();

            return $this->redirect($this->generateUrl('backend_our_work_show', array('id' => $entity->getId())));
        }

        return $this->render('SiteMainBundle:Backend/OurWork:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a OurWork entity.
     *
     * @param OurWork $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(OurWork $entity)
    {
        $form = $this->createForm(new OurWorkType(), $entity, array(
            'action' => $this->generateUrl('backend_our_work_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.create'));

        return $form;
    }

    /**
     * Displays a form to create a new OurWork entity.
     *
     */
    public function newAction()
    {
        $entity = new OurWork();
        $form   = $this->createCreateForm($entity);

        return $this->render('SiteMainBundle:Backend/OurWork:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a OurWork entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:OurWork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.our_work.not_found'));
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteMainBundle:Backend/OurWork:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing OurWork entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:OurWork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.our_work.not_found'));
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteMainBundle:Backend/OurWork:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a OurWork entity.
    *
    * @param OurWork $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(OurWork $entity)
    {
        $form = $this->createForm(new OurWorkType(), $entity, array(
            'action' => $this->generateUrl('backend_our_work_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.update'));

        return $form;
    }
    /**
     * Edits an existing OurWork entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:OurWork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.our_work.not_found'));
        }

//      Элементы работ
        $originalElements = new ArrayCollection();

        foreach ($entity->getElements() as $element) {
            $originalElements->add($element);
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
//          Элементы работ
            foreach ($originalElements as $element) {

                if (false === $entity->getElements()->contains($element)) {

                    $entity->getElements()->removeElement($element);

                    $em->remove($element);

                }

            }

            foreach ($entity->getElements() as $element) {
                $element->setOurWork($entity);
            }

            $em->flush();

            return $this->redirect($this->generateUrl('backend_our_work_edit', array('id' => $id)));
        }

        return $this->render('SiteMainBundle:Backend/OurWork:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a OurWork entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiteMainBundle:OurWork')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException($this->get('translator')->trans('backend.our_work.not_found'));
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_our_work_index'));
    }

    /**
     * Creates a form to delete a OurWork entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_our_work_delete', array('id' => $id)))
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
