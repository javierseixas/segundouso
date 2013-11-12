<?php

namespace SegundoUso\AdBundle\Form\Type;

use SegundoUso\AdBundle\Form\DataTransformer\AdvertiserToEmailTransformer;
use SegundoUso\AdBundle\Model\AdvertiserManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdvertiserEmailType extends AbstractType
{
    /**
     * @var \SegundoUso\AdBundle\Model\AdvertiserManagerInterface
     */
    private $am;

    public function __construct(AdvertiserManagerInterface $am)
    {
        $this->am = $am;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new AdvertiserToEmailTransformer($this->am);
        $builder->addModelTransformer($transformer);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'invalid_message' => 'El email introducido no es válido'
        ));
    }

    public function getParent()
    {
        return 'email';
    }

    public function getName()
    {
        return 'advertiser_email';
    }
}