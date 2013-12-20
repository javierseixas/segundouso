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
            ->add('municipality', 'entity', array(
                'class' => 'SegundoUso\LocationBundle\Entity\Municipality',
                'label' => 'Ciudad',
                'empty_value' => "Selecciona una ciudad"
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
            ->add('advertiser', 'advertiser_email')
            ->add('images', 'collection', array(
                'type' => new AdImageType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
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
        return 'ad';
    }
}