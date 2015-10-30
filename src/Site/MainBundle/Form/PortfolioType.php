<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PortfolioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array(
                'required' => true,
                'label' => 'backend.portfolio.title'
            ))
            ->add('metaTitle', 'text', array(
                'required' => false,
                'label' => 'backend.portfolio.metatitle'
            ))
            ->add('metaDescription', 'textarea', array(
                'required' => false,
                'label' => 'backend.portfolio.metadescription'
            ))
            ->add('metaKeywords', 'text', array(
                'required' => false,
                'label' => 'backend.portfolio.metakeywords'
            ))
            ->add('sliderGallery', 'file', array(
                'required' => false,
                'label' => 'backend.portfolio.sliderGallery',
                'attr' => array(
                    'class' => 'uploadifySlider',
                    'multiple' => true
                )
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.portfolio.img'
            ))
            ->add('description', 'textarea', array(
                'required' => false,
                'label' => 'backend.portfolio.description'
            ))
            ->add('text', 'textarea', array(
                'required' => false,
                'label' => 'backend.portfolio.text',
                "attr" => array(
                    "class" => "ckeditor"
                )
            ))
            ->add('position', null, array(
                'required' => false,
                'label' => 'backend.portfolio.position'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Portfolio',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_portfolio';
    }
}
