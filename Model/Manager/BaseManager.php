<?php

namespace YV\MultiCurrencyBundle\Model\Manager;

use Doctrine\ORM\EntityManager;

use Symfony\Component\EventDispatcher\EventDispatcher;

abstract class BaseManager
{
    protected $entityManager;
    
    protected $eventDispatcher;
    
    protected $repository;
    
    protected $className;
    
    public function __construct(EntityManager $entityManager, EventDispatcher $eventDispatcher, $className) 
    {        
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->className = $className;
        $this->repository = $this->entityManager->getRepository($this->className);
    }
    
    public function getClassName()
    {
        return $this->className;
    }
    
    public function getRepository()
    {
        return $this->repository;
    }
    
    public function getEntityManager()
    {
        return $this->entityManager;
    }
    
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }
    
    public function flush()
    {
        $this->entityManager->flush();
    }
    
    public function persist($object)
    {
        $this->entityManager->persist($object);
    }
    
    public function remove($object)
    {
        $this->entityManager->remove($object);
    }    
    
    public function create()
    {
        return new $this->className();
    }
    
    public function delete($object, $withFlush = true)
    {
        $this->remove($object);
        
        if($withFlush) {
            $this->flush();
        }
    }    
    
    public function save($object, $withFlush = true)
    {
        $this->persist($object);
        
        if($withFlush) {
            $this->flush();
        }
    }
}