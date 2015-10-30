<?php

namespace Site\MainBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\MainBundle\Entity\Portfolio;
use Site\MainBundle\Entity\Image;
use Site\MainBundle\Entity\Slider;
use Site\MainBundle\Form\PortfolioType;

/**
 * Portfolio controller.
 *
 */
class PortfolioController extends Controller
{

    /**
     * Lists all Slider entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiteMainBundle:Portfolio')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1) /*page number*/,
            10/*limit per page*/
        );

        return $this->render('SiteMainBundle:Backend/Portfolio:index.html.twig', array(
            'entities' => $pagination,
        ));
    }
    /**
     * Creates a new Portfolio entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Portfolio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

//          Добавляем фотки в слайдер
            $imagesJson = $request->get('sliderGallery');
            if ($imagesJson) {

                $images = json_decode($imagesJson);

                foreach ($images as $image) {
                    $slider = new Slider();
                    $slider->setImg("uploads/slider/" . $image);
                    $slider->setPortfolio($entity);
                    $em->persist($slider);
                }

            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_portfolio_show', array('id' => $entity->getId())));
        }

        return $this->render('SiteMainBundle:Backend/Portfolio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Slider entity.
     *
     * @param Portfolio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Portfolio $entity)
    {
        $form = $this->createForm(new PortfolioType(), $entity, array(
            'action' => $this->generateUrl('backend_portfolio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Portfolio entity.
     *
     */
    public function newAction()
    {
        $entity = new Portfolio();
        $form   = $this->createCreateForm($entity);

        return $this->render('SiteMainBundle:Backend/Portfolio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Portfolio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Portfolio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.portfolio.not_found'));
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteMainBundle:Backend/Portfolio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Slider entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Portfolio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.portfolio.not_found'));
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteMainBundle:Backend/Portfolio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Slider entity.
    *
    * @param Portfolio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Portfolio $entity)
    {
        $form = $this->createForm(new PortfolioType(), $entity, array(
            'action' => $this->generateUrl('backend_portfolio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.update'));

        return $form;
    }
    /**
     * Edits an existing Portfolio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Portfolio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.portfolio.not_found'));
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

//          Добавляем фотки в слайдер
            $imagesJson = $request->get('sliderGallery');
            if ($imagesJson) {

                $images = json_decode($imagesJson);

                foreach ($images as $image) {
                    $slider = new Slider();
                    $slider->setImg("uploads/slider/" . $image);
                    $slider->setPortfolio($entity);
                    $em->persist($slider);
                }

            }

//          Удаляем фотки из слайдера, отмеченные на удаление
            $sliders = $request->get('sliders');

            if(is_array($sliders)){
                foreach($sliders as $slider){
                    $repository_slider = $this->getDoctrine()->getRepository('SiteMainBundle:Slider');
                    $sliderObject = $repository_slider->find($slider);

                    if($sliderObject){
                        if(file_exists($sliderObject->getImg())){
                            unlink($sliderObject->getImg());
                        }
                        $em->remove($sliderObject);
                    }
                }
            }

            $em->flush();

            return $this->redirect($this->generateUrl('backend_portfolio_edit', array('id' => $id)));
        }

        return $this->render('SiteMainBundle:Backend/Portfolio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Portfolio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiteMainBundle:Portfolio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException($this->get('translator')->trans('backend.portfolio.not_found'));
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_portfolio_index'));
    }

    /**
     * Creates a form to delete a Portfolio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_portfolio_delete', array('id' => $id)))
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
