<?php

namespace YV\MultiCurrencyBundle\Model\Manager;

use YV\MultiCurrencyBundle\Model\ModelInterface\TransactionInterface;

class TransactionManager extends BaseManager
{
    public function persist(TransactionInterface $object)
    {
        parent::persist($object);
    }
    
    public function remove(TransactionInterface $object)
    {
        parent::remove($object);
    }    
    
    public function delete(TransactionInterface $object, $withFlush = true)
    {
        parent::delete($object, $withFlush);
    }    
    
    public function save(TransactionInterface $object, $withFlush = true)
    {
        parent::save($object, $withFlush);
    }
}