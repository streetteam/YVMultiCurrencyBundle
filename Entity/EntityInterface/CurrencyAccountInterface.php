<?php

namespace YV\MultiCurrencyBundle\Entity\EntityInterface;

interface CurrencyAccountInterface
{
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return CurrencyAccountInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt();

    /**
     * Set amount
     *
     * @param integer $amount
     * @return CurrencyAccountInterface
     */
    public function setAmount($amount);

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount();

    /**
     * Set account
     *
     * @param AccountInterface $account
     * @return CurrencyAccountInterface
     */
    public function setAccount(AccountInterface $account);

    /**
     * Get account
     *
     * @return AccountInterface
     */
    public function getAccount();

    /**
     * Set currency
     *
     * @param CurrencyInterface $currency
     * @return CurrencyAccountInterface
     */
    public function setCurrency(CurrencyInterface $currency);

    /**
     * Get currency
     *
     * @return CurrencyInterface
     */
    public function getCurrency();

    /**
     * Add transaction
     *
     * @param TransactionInterface $transaction
     * @return CurrencyAccountInterface
     */
    public function addTransaction(TransactionInterface $transaction);

    /**
     * Get transaction
     *
     * @return ArrayCollection
     */
    public function getTransactions();
    
    /**
     * @param integer $amount
     * @return boolean false if not enough amount of currency
     */
    public function changeAmount($amount);
}

