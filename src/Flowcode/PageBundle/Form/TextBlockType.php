<?php

namespace Flowcode\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TextBlockType extends AbstractType {

    protected $availableTypes;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('name')
                ->add('content')
                ->add('page', null, array("read_only" => true))
                ->add('type', 'hidden', array(
                    'data' => 'type_text',
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Flowcode\PageBundle\Entity\Block'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'flowcode_pagebundle_block';
    }

}
