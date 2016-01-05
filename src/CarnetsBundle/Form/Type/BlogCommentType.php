<?php

namespace CarnetsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogCommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('authorName')
            ->add('authorMail',null, array('required' => false))
            ->add('contenu')
            ->add('arcticle')
//            ->add('arcticle',null,array( 'attr'=>array('style'=>'display:none;')) )
            ->add('reply')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetsBundle\Entity\BlogComment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'carnetsbundle_blogcomment';
    }
}
