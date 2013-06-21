<?php

namespace YV\MultiCurrencyBundle\Model\Manager;

use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyInterface;

use YV\MultiCurrencyBundle\Event\DeleteCurrencyEvent;
use YV\MultiCurrencyBundle\Event\PreDeleteCurrencyEvent;
use YV\MultiCurrencyBundle\Event\PostDeleteCurrencyEvent;
use YV\MultiCurrencyBundle\Event\AddCurrencyEvent;
use YV\MultiCurrencyBundle\Event\PreAddCurrencyEvent;
use YV\MultiCurrencyBundle\Event\PostAddCurrencyEvent;

use YV\MultiCurrencyBundle\YVMultiCurrencyEvents;

class CurrencyManager extends BaseManager
{    
    /**
     * @param DeleteCurrencyEvent $event
     * @return boolean
     */
    public function deleteCurrency(DeleteCurrencyEvent $event)
    {
        $result = true;

        $user = $event->getUser();
        /* @var $user User */
        
        $currency = $event->getCurrency();
        /* @var $currency Currency */
        
        $preEvent = new PreDeleteCurrencyEvent($currency, $user);
        $this->eventDispatcher->dispatch(YVMultiCurrencyEvents::MULTI_CURRENCY_PRE_DELETE_CURRENCY, $preEvent);
        
        if($user->canDeleteCurrency()) {
            $this->delete($currency);
        } else {
            $result = false;
        }
        
        $postEvent = new PostDeleteCurrencyEvent($currency, $user, $result);
        $this->eventDispatcher->dispatch(YVMultiCurrencyEvents::MULTI_CURRENCY_POST_DELETE_CURRENCY, $postEvent);
        
        return $result;
    }
    
    /**
     * @param AddCurrencyEvent $event
     * @return boolean
     */
    public function addCurrency(AddCurrencyEvent $event)
    {
        $result = true;

        $user = $event->getUser();
        /* @var $user User */
        
        $currency = $event->getCurrency();
        /* @var $currency Currency */
        
        $preEvent = new PreAddCurrencyEvent($currency, $user);
        $this->eventDispatcher->dispatch(YVMultiCurrencyEvents::MULTI_CURRENCY_PRE_ADD_CURRENCY, $preEvent);
        
        if($user->canAddCurrency()) {
            $this->save($currency);
        } else {
            $result = false;
        }
        
        $postEvent = new PostAddCurrencyEvent($currency, $user, $result);
        $this->eventDispatcher->dispatch(YVMultiCurrencyEvents::MULTI_CURRENCY_POST_ADD_CURRENCY, $postEvent);
        
        return $result;
    }    
}