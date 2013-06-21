<?php

namespace YV\MultiCurrencyBundle\Model\Manager;

use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyAccountInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\AccountInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyInterface;

use YV\MultiCurrencyBundle\Event\ChangeAmountEvent;
use YV\MultiCurrencyBundle\Event\PreChangeAmountEvent;
use YV\MultiCurrencyBundle\Event\PostChangeAmountEvent;

use YV\MultiCurrencyBundle\YVMultiCurrencyEvents;

class CurrencyAccountManager extends BaseManager
{   
    /**
     * @param CurrencyAccountInterface $currencyAccount
     * @param ChangeAmountEvent $event
     * @return boolean false if not enough amount of currency
     */
    public function changeAmount(CurrencyAccountInterface $currencyAccount, ChangeAmountEvent $event)
    {
        $result = true;
        
        $preEvent = new PreChangeAmountEvent($event->getCurrency(), $event->getUser(), $event->getAmount(), $event->getTitle());
        $this->eventDispatcher->dispatch(YVMultiCurrencyEvents::MULTI_CURRENCY_PRE_CHANGE_AMOUNT, $preEvent);
        
        $newAmount = $currencyAccount->getAmount() + ((int)$event->getAmount());
        
        if($newAmount < 0) {
            $result = false;
        } else {
            $currencyAccount->setAmount($newAmount);
            $this->persist($currencyAccount);
        }
        
        $postEvent = new PostChangeAmountEvent($event->getCurrency(), $event->getUser(), $event->getAmount(), $event->getTitle(), $result);
        $this->eventDispatcher->dispatch(YVMultiCurrencyEvents::MULTI_CURRENCY_POST_CHANGE_AMOUNT, $postEvent);
        
        return $result;
    }
    
    /**
     * get currency account
     * 
     * @param AccountInterface $account
     * @param CurrencyInterface $currency
     * 
     * @return CurrencyAccountInterface
     */
    public function getCurrencyAccount(AccountInterface $account, CurrencyInterface $currency)
    {
        $currencyAccount = $account->getCurrencyAccount($currency);
        /* @var $currencyAccount \YV\MultiCurrencyBundle\Model\CurrencyAccount */
        
        if (!is_object($currencyAccount)) {
            $currencyAccount = $this->create();
            $currencyAccount->setAccount($account);
            $currencyAccount->setCurrency($currency);
            $currencyAccount->setAmount();
            
            $account->addCurrencyAccount($currencyAccount);
            
            $this->save($currencyAccount);
        }
        
        return $currencyAccount;
    }
}