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
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.portfolio.img'
            ))
            ->add('gallery', 'file', array(
                'required' => false,
                'label' => 'backend.portfolio.images',
                'attr' => array(
                    'class' => 'uploadify',
                    'multiple' => true
                )
            ))
            ->add('description', 'textarea', array(
                'required' => false,
                'label' => 'backend.portfolio.description'
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
