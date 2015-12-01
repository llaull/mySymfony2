<?php

namespace CarnetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class LieuType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('created')
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
            )
            ->add('departLieu')
        ;


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
