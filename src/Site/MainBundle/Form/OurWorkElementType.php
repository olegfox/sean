<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OurWorkElementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'required' => true,
                'label' => 'backend.our_work_element.title'
            ))
            ->add('metaTitle', 'text', array(
                'required' => false,
                'label' => 'backend.our_work_element.metatitle'
            ))
            ->add('metaDescription', 'textarea', array(
                'required' => false,
                'label' => 'backend.our_work_element.metadescription',
                'attr' => array(
                    'placeholder' => 'backend.our_work_element.metadescription'
                )
            ))
            ->add('metaKeywords', 'text', array(
                'required' => false,
                'label' => 'backend.our_work_element.metakeywords'
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.our_work_element.img'
            ))
            ->add('text', 'textarea', array(
                'required' => false,
                'label' => 'backend.our_work_element.text',
                "attr" => array(
                    'placeholder' => 'backend.our_work_element.text'
                )
            ))
            ->add('position', null, array(
                'required' => true,
                'label' => 'backend.our_work_element.position'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\OurWorkElement',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_our_work_element';
    }
}
