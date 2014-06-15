<?php

namespace Flowcode\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title')
                ->add('image')
                ->add('abstract')
                ->add('content', 'ckeditor')
                ->add('enabled', null, array('required' => false,))
                ->add('tags')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Flowcode\NewsBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'flowcode_newsbundle_post';
    }

}
