<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parent', 'entity', array(
                'required' => false,
                'label' => 'backend.products.parent',
                'class' => 'Site\MainBundle\Entity\Products',
            ))
            ->add('title', 'text', array(
                'required' => true,
                'label' => 'backend.products.title'
            ))
            ->add('metaTitle', 'text', array(
                'required' => false,
                'label' => 'backend.products.metatitle'
            ))
            ->add('metaDescription', 'textarea', array(
                'required' => false,
                'label' => 'backend.products.metadescription'
            ))
            ->add('metaKeywords', 'text', array(
                'required' => false,
                'label' => 'backend.products.metakeywords'
            ))
            ->add('text', 'textarea', array(
                'required' => false,
                'label' => 'backend.products.text',
                "attr" => array(
                    "class" => "ckeditor"
                )
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.products.img'
            ))
            ->add('hideMenu', 'choice', array(
                'required' => true,
                'label' => 'backend.products.hideMenu',
                'choices' => array(
                    0 => 'Нет',
                    1 => 'Да'
                )
            ))
            ->add('main', 'choice', array(
                'required' => true,
                'label' => 'backend.products.main',
                'choices' => array(
                    0 => 'Нет',
                    1 => 'Да'
                )
            ))
            ->add('relax', 'choice', array(
                'required' => true,
                'label' => 'backend.products.relax',
                'choices' => array(
                    0 => 'Нет',
                    1 => 'Да'
                )
            ))
            ->add('position', null, array(
                'required' => true,
                'label' => 'backend.products.position'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Products',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_products';
    }
}
