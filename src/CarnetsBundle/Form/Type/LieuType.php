<?php

namespace CarnetsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LieuType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville')
            ->add('carnet')
            ->add('dateArrived')
            ->add('dateArrived', 'date', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'date'),
                )
            )
            ->add('dateDeparture', 'date', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'date'),
                )
            );

        $builder->add('contenu', 'ckeditor', array(
            'label' => 'Contenu',
        ));

        $builder->add('useInMenu', 'checkbox', array('required' => false, 'label' => 'afficher dans le menu'))
            ->add('useInPath', 'checkbox', array('required' => false, 'label' => 'afficher sur la carte'));

        $builder->add('imageAccueil', 'elfinder', array(
            'instance' => 'form',
            'label' => 'image de l\'accueil',
            'required' => true,
            'attr' => array('class' => 'form-control')
        ))
            ->add('imageHeader', 'elfinder', array(
                'instance' => 'form',
                'label' => 'header du carnet',
                'required' => true,
                'attr' => array('class' => 'form-control')
            ));

        $builder
            ->add('lat', null, array('read_only' => true))
            ->add('lng', null, array('read_only' => true)
            );

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetsBundle\Entity\Lieu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'carnetsbundle_lieu';
    }
}
