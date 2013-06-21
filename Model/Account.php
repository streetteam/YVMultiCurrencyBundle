<?php

namespace YV\MultiCurrencyBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

use YV\MultiCurrencyBundle\Model\ModelInterface\AccountInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyAccountInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\UserInterface;

/**
 * 
 * @ORM\MappedSuperclass
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
     * @param UserInterface $user
     * @return Account
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add currency account
     *
     * @param CurrencyAccountInterface $currencyAccount
     * @return Account
     */
    public function addCurrencyAccount(CurrencyAccountInterface $currencyAccount)
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
     * @param CurrencyInterface $currency
     * @return CurrencyAccountInterface
     */
    public function getCurrencyAccount(CurrencyInterface $currency)
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