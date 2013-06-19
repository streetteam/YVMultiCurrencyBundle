<?php

namespace YV\MultiCurrencyBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use YV\MultiCurrencyBundle\Model\ModelInterface\UserInterface;
use  YV\MultiCurrencyBundle\Model\ModelInterface\AccountInterface;

/**
 * 
 * @MappedSuperclass
 */
abstract class User implements UserInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * The account related to this user
     *
     * @ORM\OneToOne(targetEntity="Account", mappedBy="user")
     */
    protected $account;    
    
    /**
     * @var DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;     

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set account
     *
     * @param AccountInterface $account
     * @return User
     */
    public function setAccount(AccountInterface $account)
    {
        $this->account = $account;
    
        return $this;
    }

    /**
     * Get account
     *
     * @return AccountInterface
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Check if user can delete currency
     * @TODO integration
     * 
     * @return boolean
     */
    public function canDeleteCurrency()
    {
        return true;
    }

    /**
     * Check if user can add currency
     * @TODO integration
     * 
     * @return boolean
     */
    public function canAddCurrency()
    {
        return true;
    }
}