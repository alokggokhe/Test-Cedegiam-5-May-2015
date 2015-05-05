<?php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditMslType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('firstName', 'text', array('label' => 'First Name'));
        $builder->add('lastName', 'text', array('label' => 'Last Name'));
        $builder->add('email', 'text', array('label' => 'Email'));
        $builder->add('mslTerritory', 'text', array('label' => 'User Territories'));
        $builder->add('gender', 'choice', array(
            'choices' => array('Male' => 'Male', 'Female' => 'Female'),
            'label' => 'Gender'
        ));
        $builder->add('role', 'choice', array(
            'choices' => array('SR' => 'SR', 'MSL' => 'MSL', 'HQ' => 'HQ'),
            'label' => 'Role'
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Msl',
        ));
    }
    public function getName()
    {
        return 'edit_msl';
    }
}
