<?php

namespace YV\MultiCurrencyBundle\Lib\Chain;

abstract class BaseChain 
{
	private $chain;
	
    public function __construct()
    {
        $this->chain = array();
    }

    protected function add($item, $alias)
    {
        $this->chain[$alias] = $item;
    }

    protected function get($alias)
    {
        if (array_key_exists($alias, $this->chain)) {
           return $this->chain[$alias];
        }

		throw new \Exception(sprintf('Item with alias "%s" does not exist in a chain.', $alias));
    }	
}

?>
