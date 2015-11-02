<?php

namespace CarnetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('created')
            ->add('titre')
            ->add('lieu')
            ->add('contenu')
            ;


        $builder->add('contenu', 'ckeditor', array (
        'label' => 'Contenu',
    ));


//        $builder->add('contenu', 'ckeditor', array(
//            'label' => 'Contenu',
//            'config_name' => 'my_custom_config',
//            'config' => array(
//                'language' => 'fr'
//            ),
//        ));


//        $builder->add('contenu', 'ckeditor', array(
//            'config' => array(
//                'filebrowserBrowseRoute' => 'elfinder',
//                'toolbar' => array(
//                    array(
//                        'name'  => 'document',
//                        'items' => array('Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates'),
//                    ),
//                    '/',
//                    array(
//                        'name'  => 'basicstyles',
//                        'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
//                    ),
//                ),
//                'uiColor' => '#ffffff',
//                //...
//            ),
//        ));

//        $builder->add('contenu', 'ckeditor', array(
//            'plugins' => array(
//                'wordcount' => array(
//                    'path'     => '/bundles/mybundle/wordcount/',
//                    'filename' => 'plugin.js',
//                ),
//            ),
//        ));

//        $builder->add('contenu','elfinder', array('instance'=>'form', 'enable'=>true));
//        $builder->add('contenu', 'ckeditor', array(
//            'config' => array(
//                'filebrowserBrowseRoute' => 'elfinder',
//                'filebrowserBrowseRouteParameters' => array('instance' => 'default')
//            ),
//        ));


//        $builder->add('contenu', 'ckeditor', array(
//            'config' => array(
//                'extraPlugins' => 'wordcount',
//            ),
//        ));

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarnetsBundle\Entity\Page'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'carnetsbundle_page';
    }
}
