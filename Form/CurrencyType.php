<?php

namespace YV\MultiCurrencyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CurrencyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder->add('name');
        
        $builder->addEventSubscriber(new FileFieldSubscriber());
    }

    public function getName()
    {
        return 'yv_multi_currency_currency_type';
    }
}