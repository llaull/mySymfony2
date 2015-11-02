<?php

namespace ProgrammeTvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChannelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idKazer')
            ->add('name')
            ->add('codeTV')
            ->add('codeZappette')
        ;
        $builder->add('idKazer', null, array('disabled' => true));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProgrammeTvBundle\Entity\Channel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'programmetvbundle_channel';
    }
}
