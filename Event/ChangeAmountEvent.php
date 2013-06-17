<?php

namespace YV\MultiCurrencyBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\UserInterface;

class ChangeAmountEvent extends Event
{
    const NAME = 'yv_multi_currency.change_amount';
    
    protected $currency;

    protected $user;
    
    protected $amount;
    
    protected $title;

    public function __construct(CurrencyInterface $currency, UserInterface $user, $amount, $title)
    {
        $this->currency = $currency;
        $this->user = $user;
        $this->amount = $amount;
        $this->title = $title;
    }

    public function getCurrency()
    {
        return $this->currency;
    } 
    
    public function getUser()
    {
        return $this->user;
    } 
    
    public function getAmount()
    {
        return $this->amount;
    } 
    
    public function getTitle()
    {
        return $this->title;
    }
}
