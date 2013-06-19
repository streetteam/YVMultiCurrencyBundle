<?php

namespace YV\MultiCurrencyBundle\Model\Manager;

use YV\MultiCurrencyBundle\Model\ModelInterface\AccountInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\UserInterface;

class AccountManager extends BaseManager
{
    public function persist(AccountInterface $object)
    {
        parent::persist($object);
    }
    
    public function remove(AccountInterface $object)
    {
        parent::remove($object);
    }    
    
    public function delete(AccountInterface $object, $withFlush = true)
    {
        parent::delete($object, $withFlush);
    }    
    
    public function save(AccountInterface $object, $withFlush = true)
    {
        parent::save($object, $withFlush);
    }

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
            /* @var $currencyAccount CurrencyAccount */
            
            $currencyAccountManager->persist($currencyAccount);
        
            $account->addCurrencyAccount($currencyAccount);
            $this->save($account);
        }
        
        return $account;
    }        
}