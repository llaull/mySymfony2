<?php

namespace Domotique\bundle\TaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LogType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created')
            ->add('source')
            ->add('destination')
            ->add('reponse')
            ->add('idTask')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Domotique\bundle\TaskBundle\Entity\Log'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'domotique_bundle_taskbundle_log';
    }
}
