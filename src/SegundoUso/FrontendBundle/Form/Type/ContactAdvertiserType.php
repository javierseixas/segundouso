<?php

namespace SegundoUso\FrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactAdvertiserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
            ->add('name', 'text', array(
                'constraints' => new NotBlank()
            ))
            ->add('email', 'email', array(
                'constraints' => new Email()
            ))
            ->add('message', 'textarea', array(
                'constraints' => new NotBlank()
            ))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

    public function getName()
    {
        return 'contact_advertiser_form';
    }
}