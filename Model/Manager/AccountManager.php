<?php

namespace YV\MultiCurrencyBundle\Model\Manager;

use YV\MultiCurrencyBundle\Model\ModelInterface\AccountInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\UserInterface;

class AccountManager extends BaseManager
{
    /**
     * get account
     * 
     * @param UserInterface $user
     * @return AccountInterface
     */
    public function getAccount(UserInterface $user, CurrencyAccountManager $currencyAccountManager)
    {
        $account = $user->getAccount();
        /* @var $account Account */        

        if ($account === null) {
            $account = $this->create();
            $account->setUser($user);

            $currencyAccount = $currencyAccountManager->create();
            /* @var $currencyAccount \YV\MultiCurrencyBundle\Model\CurrencyAccount */
            
            $currencyAccount->setAmount();
            $currencyAccountManager->persist($currencyAccount);
        
            $account->addCurrencyAccount($currencyAccount);
            $this->save($account);
        }
        
        return $account;
    }        
}