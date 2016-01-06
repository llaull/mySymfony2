<?php

namespace CarnetsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category')
            ->add('publied', 'date', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'date'),
                )
            )
            ->add('title')
            ->add('contenu', 'ckeditor', array(
                'label' => 'Contenu',
            ))
            ->add('image', 'elfinder', array(
                'instance' => 'form',
                'label' => 'header du carnet',
                'required' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('actived')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetsBundle\Entity\BlogArticle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'carnetsbundle_blogarticle';
    }
}
