<?php

namespace CarnetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarnetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')

            ->add('description')

            ->add('destination', 'text', array('required' => true))

            ->add('pinterestLink', 'text', array('required' => false))

            ->add('imageHeader', 'elfinder', array(
                'instance' => 'form',
                'label' => 'header du carnet',
//                'enable' => true,
                'required' => false,
//                'mapped' => false,
                'attr' => array('class' => 'form-control')
            ))

            ->add('depart', 'date', array(
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy',
                'required' => true,
                'attr' => array('class' => 'date')
            ));

        $builder
            ->add('actived', 'checkbox', array(
                'required' => false,
                'label' => 'Afficher dans l\'accueil'
            ));

        $builder
            ->add('contenu', 'ckeditor', array(
                'label' => 'Contenu',
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetsBundle\Entity\Carnet'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'carnetsbundle_carnet';
    }
}
