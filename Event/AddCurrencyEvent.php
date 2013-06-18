<?php

namespace YV\MultiCurrencyBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\UserInterface;

class AddCurrencyEvent extends Event
{
    protected $currency;

    protected $user;
    
    public function __construct(CurrencyInterface $currency, UserInterface $user)
    {
        $this->currency = $currency;
        $this->user = $user;
    }

    public function getCurrency()
    {
        return $this->currency;
    } 
    
    public function getUser()
    {
        return $this->user;
    } 
    
    
}
