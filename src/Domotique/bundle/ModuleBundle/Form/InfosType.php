<?php

namespace Domotique\bundle\ModuleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InfosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('moduleRef')
            ->add('moduleNom', NULL, array('label' => 'nom'))
            ->add('nrfId', NULL, array('label' => 'adresse'))
            ->add('moduleType',NULL, array('label' => 'type'))
            ->add('emplacement')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Domotique\bundle\ModuleBundle\Entity\Infos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'domotique_bundle_modulebundle_infos';
    }
}
