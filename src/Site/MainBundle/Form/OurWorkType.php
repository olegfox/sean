<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OurWorkType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', 'entity', array(
                'required' => false,
                'label' => 'backend.our_work.product',
                'class' => 'Site\MainBundle\Entity\Products',
            ))
            ->add('title', 'text', array(
                'required' => true,
                'label' => 'backend.our_work.title'
            ))
            ->add('textTop', 'textarea', array(
                'required' => false,
                'label' => 'backend.our_work.textTop',
                "attr" => array(
                    "class" => "ckeditor"
                )
            ))
            ->add('textBottom', 'textarea', array(
                'required' => false,
                'label' => 'backend.our_work.textBottom',
                "attr" => array(
                    "class" => "ckeditor"
                )
            ))
            ->add('position', null, array(
                'required' => true,
                'label' => 'backend.our_work.position'
            ))
            ->add('elements', 'bootstrap_collection', array(
                'label'=>'backend.our_work.elements',
                'type' => new OurWorkElementType(),
                'allow_add'          => true,
                'allow_delete'       => true,
                'add_button_text'    => 'backend.our_work_element.add',
                'delete_button_text' => 'backend.our_work_element.delete',
                'sub_widget_col'     => 12,
                'button_col'         => 0,
                'prototype_name'     => 'inlinep',
                'options'            => array(
                    'attr' => array('style' => 'inline')
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\OurWork',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_our_work';
    }
}
