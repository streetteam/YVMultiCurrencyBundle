<?php

namespace YV\MultiCurrencyBundle\Entity\EntityInterface;

interface TransactionInterface
{
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return TransactionInterface
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
     * @return TransactionInterface
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
     * @param CurrencyAccountInterface $currencyAccount
     * @return TransactionInterface
     */
    public function setCurrencyAccount(CurrencyAccountInterface $currencyAccount);

    /**
     * Get currencyAccount
     *
     * @return CurrencyAccountInterface
     */
    public function getCurrencyAccount();

    /**
     * Set title
     *
     * @param string $title
     * @return TransactionInterface
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();
}

