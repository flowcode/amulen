<?php

namespace Flowcode\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('username')
                ->add('password')
                ->add('email')
                ->add('enabled', null, array("required" => false))
                ->add('locked', null, array("required" => false))
                ->add('groups', 'entity', array(
                        'class' => 'FlowcodeUserBundle:UserGroup',
                        'property' => 'name',
                        'multiple' => true,
                     ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Flowcode\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'flowcode_userbundle_user';
    }

}
