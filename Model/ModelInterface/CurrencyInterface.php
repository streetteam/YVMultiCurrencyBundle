<?php

namespace YV\MultiCurrencyBundle\Model\ModelInterface;

interface CurrencyInterface
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
     * Set name
     *
     * @param string $name
     * @return CurrencyInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set slug
     *
     * @param string $slug
     * @return CurrencyInterface
     */
    public function setSlug($slug);

    /**
     * Get name
     *
     * @return string
     */
    public function getSlug();
    
    /**
     * Add currencyAccount
     *
     * @param CurrencyAccountInterface $currencyAccount
     * @return Currency
     */
    public function addCurrencyAccount(CurrencyAccountInterface $currencyAccount);

    /**
     * Get CurrencyAccounts
     *
     * @return ArrayCollection
     */
    public function getCurrencyAccounts();
    
}

