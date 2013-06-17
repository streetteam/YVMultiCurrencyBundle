<?php

namespace YV\MultiCurrencyBundle\Model\ModelInterface;

interface UserInterface
{
    /**
     * Set name
     *
     * @param string $name
     * @return UserInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string 
     */
    public function getName();

    /**
     * Set email
     *
     * @param string $email
     * @return UserInterface
     */
    public function setEmail($email);

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail();

    /**
     * Set account
     *
     * @param AccountInterface $account
     * @return UserInterface
     */
    public function setAccount(AccountInterface $account = null);

    /**
     * Get account
     *
     * @return AccountInterface
     */
    public function getAccount();
}

