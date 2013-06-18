<?php

namespace YV\MultiCurrencyBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;

use YV\MultiCurrencyBundle\Model\ModelInterface\FileUploadableInterface;

class FileUploadListener
{
    protected $uploadDir;
    
    protected $uploadRootDir;
    
    public function __construct($uploadDir, $uploadRootDir) 
    {
        $this->uploadDir = $uploadDir;
        $this->uploadRootDir = $uploadRootDir;
    }
    
    public function postPersist(LifecycleEventArgs $args)
    {
        if($entity = $this->setPaths($args)) {
            $entity->upload();
        }
    }
    
    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->setPaths($args);
    }
    
    public function postLoad(LifecycleEventArgs $args)
    {
        $this->setPaths($args);
    }    
    
    protected function setPaths(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // TODO: set other paths here
        if($entity instanceof FileUploadableInterface) {
            $entity->setUploadDir($this->uploadDir);
            $entity->setUploadRootDir($this->uploadRootDir);
            
            return $entity;
        }        
        
        return null;
    }        
}
