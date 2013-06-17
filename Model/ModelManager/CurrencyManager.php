<?php

namespace YV\MultiCurrencyBundle\Model\Manager;

use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyInterface;

class CurrencyManager extends BaseManager
{
    public function persist(CurrencyInterface $object)
    {
        parent::persist($object);
    }
    
    public function remove(CurrencyInterface $object)
    {
        parent::remove($object);
    }    
    
    public function delete(CurrencyInterface $object, $withFlush = true)
    {
        parent::delete($object, $withFlush);
    }    
    
    public function save(CurrencyInterface $object, $withFlush = true)
    {
        parent::save($object, $withFlush);
    }
}