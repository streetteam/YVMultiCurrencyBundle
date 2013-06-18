<?php

namespace YV\MultiCurrencyBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File as BaseFile;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\FileUploadableInterface;

/**
 * 
 * @MappedSuperclass
 */
abstract class Currency implements CurrencyInterface, FileUploadableInterface
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
     * @var DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;     
    
    // image upload
    
    /**
     * @var string $imageName
     *
     * @ORM\Column(name="image_name", type="string", length=255)
     */
    protected $imageName;     
    
    /**
     * @Assert\Image(maxSize="6000000")
     */
    public $file;
    
    protected $uploadRootDir;
    
    protected $uploadDir; 
    
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
    
    // image upload
    
    /**
     * Set imageName
     *
     * @param string $imageName
     * @return Currency
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    
        return $this;
    }

    /**
     * Get imageName
     *
     * @return string 
     */
    public function getImageName()
    {
        return $this->imageName;
    }    
    
    /**
     * @return string|null
     */
    public function getAbsolutePath()
    {
        return $this->getImageName() === null ? null : sprintf('%s/%s', $this->getUploadRootDir(), $this->getImageName());
    }
    
    /**
     * @return string|null
     */
    public function getWebPath()
    {
        return $this->getImageName() === null ? null : sprintf('%s/%s', $this->getUploadDir(), $this->getImageName());
    }
    
    /**
     * @param string $uploadRootDir
     * @return Currency
     */
    public function setUploadRootDir($uploadRootDir)
    {
        $this->uploadRootDir = $uploadRootDir;
        
        return $this;
    }
    
    /**
     * @return string 
     */
    public function getUploadRootDir()
    {
        if($this->uploadRootDir !== null) {
            return sprintf('%s%s', $this->uploadRootDir, $this->uploadDir);
        }
        
        throw new \Exception('Upload root directory must be set.');
    }
    
    /**
     * @param string $uploadDir
     * @return Currency
     */
    public function setUploadDir($uploadDir)
    {
        $this->uploadDir = sprintf($uploadDir, strtolower(join('', array_slice(explode('\\', get_class($this)), -1))), $this->getId());
        
        return $this;
    }
    
    /**
     * @return string 
     */
    public function getUploadDir()
    {
        if($this->uploadDir !== null) {
            return $this->uploadDir;
        }
        
        throw new \Exception('Upload directory must be set.');     
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->imageName = sprintf('%s.%s', $filename, $this->file->guessExtension());
        }
    }    
    
    /**
     * @ORM\PostUpdate()
     * 
     * @return boolean
     */
    public function upload()
    {
        if ($this->file === null || !($this->file instanceof BaseFile)) {
            return false;
        }

        $this->file->move($this->getUploadRootDir(), $this->getImageName());

        unset($this->file);

        return true;
    }

    /**
     * @ORM\PostRemove()
     * 
     * @return boolean
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            @unlink($file);
            
            return true;
        }
        
        return false;
    }     
}