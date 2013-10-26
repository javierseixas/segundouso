<?php

namespace SegundoUso\AdBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'label' => 'Título'
            ))
            ->add('location', 'text', array(
                'label' => 'Localización'
            ))
            ->add('description', 'textarea', array(
                'label' => 'Descripción'
            ))
            ->add('category', 'entity', array(
                'class' => 'SegundoUso\AdBundle\Entity\Category',
                'label' => 'Categoría',
                'empty_value' => "Selecciona una categoría"
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SegundoUso\AdBundle\Entity\Ad'
        ));
    }

    public function getName()
    {
        return 'announcement';
    }
}