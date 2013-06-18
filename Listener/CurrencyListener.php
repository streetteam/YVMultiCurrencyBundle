<?php

namespace YV\MultiCurrencyBundle\Listener;

use YV\MultiCurrencyBundle\Lib\Chain;

use YV\MultiCurrencyBundle\Event\ChangeAmountEvent;

use YV\MultiCurrencyBundle\Model\User;
use YV\MultiCurrencyBundle\Model\Account;
use YV\MultiCurrencyBundle\Model\CurrencyAccount;
use YV\MultiCurrencyBundle\Model\Transaction;

class CurrencyListener
{
    protected $chain;
    
    /**
     * Constructs a new instance of CurrencyListener.
     *
     */
    public function __construct(Chain $chain)
    {
        $this->chain = $chain;
    }

    /**
     * Change currency account amount.
     *
     * @param ChangeAmountEvent $event The event
     */
    public function onChangeAmount(ChangeAmountEvent $event)
    {
        $currencyAccountManager = $this->chain->getCurrencyAccountManager();
        $accountManager = $this->chain->getAccountManager();
        $transactionManager = $this->chain->getTransactionManager();
        
        $user = $event->getUser();
        /* @var $user User */

        $account = $accountManager->getAccount($user, $currencyAccountManager);
        /* @var $account Account */
        
        $currencyAccount = $currencyAccountManager->getCurrencyAccount($account, $event->getCurrency());
        /* @var $currencyAccount CurrencyAccount */
        
        if($currencyAccountManager->changeAmount($currencyAccount, $event)) {
            $transaction = $transactionManager->create();
            /* @var $transaction Transaction */
            
            $transaction->setTitle($event->getTitle());
            $transaction->setAmount($event->getAmount());
            $transaction->setCurrencyAccount($currencyAccount);
            
            $transactionManager->save($transaction);
        }
    }
    
    // @TODO add currency
    // @TODO delete currency
    
}
