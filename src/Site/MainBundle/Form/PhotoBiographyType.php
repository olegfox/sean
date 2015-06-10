<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PhotoBiographyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', null, array(
                'required' => true,
                'label' => 'backend.photo_biography.date',
                'years' => range(1900, date('Y'))
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.photo_biography.img'
            ))
            ->add('text', 'textarea', array(
                'required' => false,
                'label' => 'backend.photo_biography.text'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\PhotoBiography',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_photo_biography';
    }
}
