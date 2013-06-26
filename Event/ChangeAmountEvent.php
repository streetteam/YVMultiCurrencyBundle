<?php

namespace YV\MultiCurrencyBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\UserInterface;

class ChangeAmountEvent extends Event
{
    protected $currency;

    protected $user;
    
    protected $amount;
    
    protected $title;

    protected $options = array();
    
    public function __construct(CurrencyInterface $currency, UserInterface $user, $amount, $title, $options = array())
    {
        $this->currency = $currency;
        $this->user = $user;
        $this->amount = $amount;
        $this->title = $title;
        $this->options = array_merge($this->options, $options);
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
    
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * @param string $key
     */
    public function getOption($key)
    {
        return isset($this->options[$key]) ? $this->options[$key] : false;
    }
}
