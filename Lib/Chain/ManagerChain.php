<?php

namespace YV\MultiCurrencyBundle\Lib\Chain;

use YV\MultiCurrencyBundle\Model\ModelManager\BaseManager;

class ManagerChain extends BaseChain
{
    public function addManager(BaseManager $manager, $alias)
    {
        $this->add($manager, $alias);
    }

    public function getManager($alias)
    {
		return $this->get($alias);
    }	
    
    public function __call($name, $arguments) 
    {
        if(preg_match('~^get([A-Za-z]+)Manager$~', $name, $matches)) {
            $alias = $this->getAliasFromCamelCase($matches[1]);
            
            return $this->getManager($alias);
        }
        
        if(preg_match('~^get([A-Za-z]+)Repository$~', $name, $matches)) {
            $alias = $this->getAliasFromCamelCase($matches[1]);
            
            return $this->getManager($alias)->getRepository();
        }  
        
        throw new \Exception(sprintf('Call to undefined method %s in %s.', $name, get_class($this)));
    }
    
    private function getAliasFromCamelCase($camelCase)
    {
        return strtolower(preg_replace('~\B([A-Z])~', '_$1', $camelCase)) . '_manager';
    }
}

?>
