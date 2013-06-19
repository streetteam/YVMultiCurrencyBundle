<?php

namespace YV\MultiCurrencyBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use YV\MultiCurrencyBundle\Model\ModelInterface\TransactionInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyAccountInterface;

/**
 * 
 * @ORM\MappedSuperclass
 */
abstract class Transaction implements TransactionInterface
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
     * @var integer $amount
     *
     * @ORM\Column(name="amount", type="integer")
     */
    protected $amount;
        
    /**
     * The currency account related to this transaction
     * 
     * @ORM\ManyToOne(targetEntity="CurrencyAccount", cascade={"all"})
     * @ORM\JoinColumn(name="currency_account_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $currencyAccount;
        
    /**
     * @var string $title
     *  
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;    
    
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
     * @return Transaction
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
     * Set amount
     *
     * @param integer $amount
     * @return Transaction
     */
    public function setAmount($amount = 0)
    {
        $this->amount = $amount;
    
        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Transaction
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set currency account
     *
     * @param CurrencyAccountInterface $currencyAccount
     * @return Transaction
     */
    public function setCurrencyAccount(CurrencyAccountInterface $currencyAccount)
    {
        $this->currencyAccount = $currencyAccount;
    
        return $this;
    }

    /**
     * Get currency account
     *
     * @return CurrencyAccountInterface
     */
    public function getCurrencyAccount()
    {
        return $this->currencyAccount;
    }
}