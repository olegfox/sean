<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ElementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('block', 'entity', array(
                'required' => false,
                'label' => 'backend.element.block',
                'class' => 'Site\MainBundle\Entity\Block',
            ))
            ->add('title', 'text', array(
                'required' => true,
                'label' => 'backend.element.title'
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.element.img'
            ))
            ->add('text', 'textarea', array(
                'required' => false,
                'label' => 'backend.element.text',
                "attr" => array(
                    "class" => "ckeditor"
                )
            ))
            ->add('position', null, array(
                'required' => true,
                'label' => 'backend.element.position'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Element',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_element';
    }
}
