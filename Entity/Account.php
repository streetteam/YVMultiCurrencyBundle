<?php

namespace YV\MultiCurrencyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use YV\MultiCurrencyBundle\Entity\EntityInterface\AccountInterface;

/**
 * 
 * @MappedSuperclass
 */
abstract class Account implements AccountInterface
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
     * The user related to this account
     *
     * @ORM\OneToOne(targetEntity="User", mappedBy="account")
     */
    protected $user;    
    
    /**
     * The currency accounts related to this account
     *
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CurrencyAccount", mappedBy="account")
     */
    protected $currencyAccounts;    
    
    /**
     * @var DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;     
    
    /**
     * Constructs a new instance of Account
     */
    public function __construct()
    {
        $this->currencyAccounts = new ArrayCollection();
    }
    
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
     * @return Account
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
     * Set user
     *
     * @param User $user
     * @return Account
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add currency account
     *
     * @param CurrencyAccount $currencyAccount
     * @return Account
     */
    public function addCurrencyAccount(CurrencyAccount $currencyAccount)
    {
        $this->currencyAccounts[] = $currencyAccount;
    
        return $this;
    }

    /**
     * Get currency account
     *
     * @return ArrayCollection
     */
    public function getCurrencyAccounts()
    {
        return $this->currencyAccounts;
    }
    
    /**
     * @param Currency $currency
     * @return CurrencyAccount
     */
    public function getCurrencyAccount(Currency $currency)
    {
        $currencyAccount = null;
        
        foreach($this->getCurrencyAccounts() as $cAccount) {
            /* @var CurrencyAccount $cAccount */
            
            if($currency->getId() == $cAccount->getCurrency()->getId()) {
                $currencyAccount = $cAccount;
                break;
            }
        }
        
        return $currencyAccount;
    }
}