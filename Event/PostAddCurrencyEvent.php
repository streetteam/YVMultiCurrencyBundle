<?php

namespace YV\MultiCurrencyBundle\Event;

use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\UserInterface;

class PostAddCurrencyEvent extends AddCurrencyEvent
{
    protected $success;

    public function __construct(CurrencyInterface $currency, UserInterface $user, $success)
    {
        parent::__construct($currency, $user);
        $this->success = $success;
    }

    public function getSuccess()
    {
        return $this->success;
    }
}
