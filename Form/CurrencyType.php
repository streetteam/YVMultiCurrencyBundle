<?php

namespace YV\MultiCurrencyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use YV\MultiCurrencyBundle\YVMultiCurrencyBundle;

class CurrencyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder->add('name');
        
        $builder->addEventSubscriber(new FileFieldSubscriber());
    }

    public function getName()
    {
        return YVMultiCurrencyBundle::PREFIX . '_currency_type';
    }
}