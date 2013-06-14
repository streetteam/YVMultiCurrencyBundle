<?php

namespace YV\MultiCurrencyBundle\Entity\EntityInterface;

interface AccountInterface
{
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AccountInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt();

    /**
     * Set user
     *
     * @param UserInterface $user
     * @return AccountInterface
     */
    public function setUser(UserInterface $user);

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser();

    /**
     * Add currency account
     *
     * @param CurrencyAccountInterface $currencyAccount
     * @return AccountInterface
     */
    public function addCurrencyAccount(CurrencyAccountInterface $currencyAccount);

    /**
     * Get currency account
     *
     * @return ArrayCollection
     */
    public function getCurrencyAccounts();
    
    /**
     * @param CurrencyInterface $currency
     * @return CurrencyAccountInterface
     */
    public function getCurrencyAccount(CurrencyInterface $currency);
}

