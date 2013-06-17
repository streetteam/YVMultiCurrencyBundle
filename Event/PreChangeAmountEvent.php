<?php

namespace YV\MultiCurrencyBundle\Event;

class PreChangeAmountEvent extends ChangeAmountEvent
{
    const NAME = 'yv_multi_currency.pre_change_amount';
}
