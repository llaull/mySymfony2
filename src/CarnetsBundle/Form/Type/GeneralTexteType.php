<?php

namespace CarnetsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GeneralTexteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
        ;
        $builder
            ->add('useInMenu', 'checkbox', array(
                'required' => false,
                'label' => 'Afficher'
            ));

        $builder->add('contenu', 'ckeditor', array(
            'label' => 'Contenu',
        ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetsBundle\Entity\GeneralTexte'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'carnetsbundle_generaltexte';
    }
}
