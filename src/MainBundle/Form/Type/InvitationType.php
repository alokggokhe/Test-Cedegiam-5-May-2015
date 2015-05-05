<?php

namespace MainBundle\Form\Type;


use MainBundle\Entity\TopicRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InvitationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('topics', 'entity', array(
            'class' => 'MainBundle:Topic',
            'query_builder' => function(TopicRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.name', 'ASC');
                },
            'expanded' =>true,
            'multiple' => true
        ));
        $builder->add('availabilityDetails', 'choice', array(
            'choices'   => array('immediately' => 'immediately', 'schedule_an_appointment' => 'schedule an appointment'),
            'expanded' =>true,
            'multiple' => false
        ));
        $builder->add('relatedToAE');
        $builder->add('datetime');
        $builder->add('name');
        $builder->add('phone');
        $builder->add('email');
        $builder->add('question', 'textarea');
        $builder->add('submit', 'submit');


    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Invitation',
        ));
    }
    public function getName()
    {
        return 'invitation';
    }
}
