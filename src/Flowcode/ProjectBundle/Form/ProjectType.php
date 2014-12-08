<?php

namespace Flowcode\ProjectBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType {

    function __construct($categorys) {
        $this->categorys = $categorys;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('abstract')
                ->add('description', 'ckeditor')
                ->add('enabled')
                ->add('category')
                ->add('category', 'entity', array(
                    'class' => 'FlowcodeClassificationBundle:Category',
                    'choices' => $this->categorys,
                ))
                ->add('tags')
                ->add('mediaGallery')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Flowcode\ProjectBundle\Entity\Project'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'flowcode_projectbundle_project';
    }

}
