<?php

namespace YV\MultiCurrencyBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyInterface;

/**
 * 
 * @MappedSuperclass
 */
abstract class Currency implements CurrencyInterface
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
     * @var string $name
     *  
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     */
    protected $name;  
        
    /**
     * @Gedmo\Slug(fields={"id", "name"})
     * @var string $slug
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="slug", type="string", length=100, nullable=false, unique=true)
     */
    protected $slug;  
    
    /**
     * The brand related to this currency
     *
     * @ORM\OneToOne(targetEntity="Brand", mappedBy="currency")
     */
    protected $brand;
    
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
     * @return Currency
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
     * Set name
     *
     * @param string $name
     * @return Currency
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Currency
     */
    public function setSlug($slug) {
        $this->slug = $slug;
        
        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }
}