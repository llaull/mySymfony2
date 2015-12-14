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
            ->add('depart', 'date', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'dd/MM/yyyy',
                    'required' => true,
                    'attr' => array('class' => 'date'),
                )
            )

//            ->add('imageName')
//            ->add('imageName','elfinder', array('instance'=>'form', 'enable'=>true))
//            ->add('imageName', 'file', array('label' => 'Brochure (PDF file)', 'data_class' => 'Doctrine\ORM\GridFSFile'))
//            ->add('imageName', 'file', array('label' => 'Brochure (PDF file)', 'data_class' => 'Symfony\Component\HttpFoundation\File\File','property_path' => 'path'  ))
//            ->add('imageName', 'ckeditor', array(
//                    'label' => 'Upload',
//                    'required' => false,
//                    'config' => array(
//                        'filebrowser_image_browse_url' => array(
//                            'route'            => 'elfinder',
//                            'route_parameters' => array('instance' => 'default'),
//                        ),
//                    ))
//            )
        ;
        $builder
            ->add('actived', 'checkbox', array('required' => false, 'label' => 'Afficher dans l\'accueil'));

        $builder
            ->add('contenu', 'ckeditor', array(
            'label' => 'Contenu',
        ));

//        $builder->add('imageName', 'ckeditor', array (
//            'label' => 'image',
//            //'instance'=>'form', 'enable'=>true
//        ));
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
