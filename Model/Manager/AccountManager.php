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
    public function getAccount(UserInterface $user)
    {
        $account = $user->getAccount();
        /* @var $account Account */        

        if (!is_object($account)) {
            $account = $this->create();
            $account->setUser($user);
            
            $this->save($account);
        }
        
        return $account;
    }        
}