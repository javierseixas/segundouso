<?php

namespace SegundoUso\AdBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class AdType extends AbstractType
{
    protected $securityContext;

    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $sc = $this->securityContext;
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

            ->add('images', 'collection', array(
                'type' => new AdImageType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ))
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($sc) {
                $form = $event->getForm();

                if (!$sc->isGranted('ROLE_USER')) {
                    $form->add('advertiser', 'advertiser_email');
                }
            })
            ->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) use ($sc) {
                $data = $event->getForm()->getData();
                $user = $sc->getToken()->getUser();
                if (null === $data->getUser() && $sc->isGranted('ROLE_USER')) {
                    $data->setUser($user);
                }
            })
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