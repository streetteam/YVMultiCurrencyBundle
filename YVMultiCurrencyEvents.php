<?php

namespace YV\MultiCurrencyBundle;

final class YVMultiCurrencyEvents
{
    // change currency account amount 
    const MULTI_CURRENCY_CHANGE_AMOUNT = 'yv_multi_currency.change_amount';
    
    const MULTI_CURRENCY_POST_CHANGE_AMOUNT = 'yv_multi_currency.post_change_amount';
    
    const MULTI_CURRENCY_PRE_CHANGE_AMOUNT = 'yv_multi_currency.pre_change_amount';
 
    // add currency
    const MULTI_CURRENCY_ADD_CURRENCY = 'yv_multi_currency.add_currency';
    
    const MULTI_CURRENCY_POST_ADD_CURRENCY = 'yv_multi_currency.post_add_currency';
    
    const MULTI_CURRENCY_PRE_ADD_CURRENCY = 'yv_multi_currency.pre_add_currency';
    
    // delete currency
    const MULTI_CURRENCY_DELETE_CURRENCY = 'yv_multi_currency.delete_currency';
    
    const MULTI_CURRENCY_POST_DELETE_CURRENCY = 'yv_multi_currency.post_delete_currency';
    
    const MULTI_CURRENCY_PRE_DELETE_CURRENCY = 'yv_multi_currency.pre_delete_currency';
}
