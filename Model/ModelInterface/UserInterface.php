<?php

namespace YV\MultiCurrencyBundle\Model\ModelInterface;

interface UserInterface
{
    /**
     * Set account
     *
     * @param AccountInterface $account
     * @return UserInterface
     */
    public function setAccount(AccountInterface $account);

    /**
     * Get account
     *
     * @return AccountInterface
     */
    public function getAccount();
    
    /**
     * Check if user can delete currency
     * 
     * @return boolean
     */
    public function canDeleteCurrency();

    /**
     * Check if user can add currency
     * 
     * @return boolean
     */
    public function canAddCurrency();
}

