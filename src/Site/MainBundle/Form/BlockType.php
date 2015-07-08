<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlockType extends AbstractType
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
                'label' => 'backend.block.product',
                'class' => 'Site\MainBundle\Entity\Products',
            ))
            ->add('title', 'text', array(
                'required' => true,
                'label' => 'backend.block.title'
            ))
            ->add('textTop', 'textarea', array(
                'required' => false,
                'label' => 'backend.block.textTop',
                "attr" => array(
                    "class" => "ckeditor"
                )
            ))
            ->add('textBottom', 'textarea', array(
                'required' => false,
                'label' => 'backend.block.textBottom',
                "attr" => array(
                    "class" => "ckeditor"
                )
            ))
            ->add('position', null, array(
                'required' => true,
                'label' => 'backend.block.position'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Block',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_block';
    }
}
