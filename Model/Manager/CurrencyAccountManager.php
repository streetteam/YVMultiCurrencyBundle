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
        $this->dispatcher->dispatch(YVMultiCurrencyEvents::MULTI_CURRENCY_PRE_CHANGE_AMOUNT, $preEvent);
        
        $newAmount = $currencyAccount->getAmount() + $event->getAmount();
        
        if($newAmount < 0) {
            $result = false;
        } else {
            $currencyAccount->setAmount($newAmount);
            $this->persist($currencyAccount);
        }
        
        $postEvent = new PostChangeAmountEvent($event->getCurrency(), $event->getUser(), $event->getAmount(), $event->getTitle(), $result);
        $this->dispatcher->dispatch(YVMultiCurrencyEvents::MULTI_CURRENCY_POST_CHANGE_AMOUNT, $postEvent);
        
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
    private function getCurrencyAccount(AccountInterface $account, CurrencyInterface $currency)
    {
        $currencyAccount = $account->getCurrencyAccount($currency);
        /* @var $currencyAccount CurrencyAccount */
        
        if ($currencyAccount === null) {
            $currencyAccount = $this->create();
            $currencyAccount->setAccount($account);
            
            $this->save($currencyAccount);
        }
        
        return $currencyAccount;
    }
}