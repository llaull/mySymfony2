<?php

namespace Domotique\bundle\ModuleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SondeUnitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('symbole')
            ->add('nom')
            ->add('slug')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Domotique\bundle\ModuleBundle\Entity\SondeUnit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'domotique_bundle_modulebundle_sondeunit';
    }
}
