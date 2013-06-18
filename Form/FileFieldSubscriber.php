<?php

namespace YV\MultiCurrencyBundle\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FileFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData'
        );
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        // During form creation setData() is called with null as an argument
        // by the FormBuilder constructor. You're only concerned with when
        // setData is called with an actual Entity object in it (whether new
        // or fetched with Doctrine). This if statement lets you skip right
        // over the null condition.
        if (null === $data) {
            return;
        }
        
        // check if the currency object is "new"
        if ($data->getId()) {
            $form->add('file', 'file', array(
                'required' => false,
                'label' => 'Logo'
            ));
        }
        else {
            $form->add('file', 'file', array(
                'required' => true,
                'constraints' => array(
                    new NotBlank(),
                ),
                'label' => 'Logo'
            ));
        }
    }
}