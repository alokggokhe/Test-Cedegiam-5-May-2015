<?php

namespace MainBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScheduleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder           
            ->add('title', 'text', array('label' => 'Please indicate title of your presentation:'))
            ->add('firstname', 'text', array('label' => 'First name'))
            ->add('owauuid', 'hidden')
            ->add('owaonekeycode', 'hidden')
            ->add('status', 'hidden', array('data' => 'Pending'))
            ->add('lastname', 'text', array('label' => 'Last name'))
            ->add('email', 'text', array('label' => 'Email address'))
            ->add('phone', 'text', array('label' => 'Please indicate what phone number would you like the participant to call you:'))
            ->add('scheduledatetime','datetime', array('format' => "yyyy-MM-dd HH:mm",'widget' => "single_text", 'label' => 'Date and time when would like to deliver presentation?'))
            ->add('submit', 'submit', array('label' => 'CREATE AND SEND INVITATION'));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Schedule'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'schedule';
    }
}

