<?php

namespace YV\MultiCurrencyBundle\Lib\CompilerPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

abstract class BaseChainCompilerPass implements CompilerPassInterface
{
	private $chainServiceName;
	private $tagName;
	private $addingMethodName;
	
	public function __construct($pluralName, $singularName, $addingMethodName)
	{
		$this->chainServiceName = sprintf('chains.%s_chain', $singularName);
		$this->tagName = sprintf('%s.%s', $pluralName, $singularName);
		$this->addingMethodName = $addingMethodName;
	}
	
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition($this->chainServiceName)) {
            return;
        }

        $definition = $container->getDefinition($this->chainServiceName);

        foreach ($container->findTaggedServiceIds($this->tagName) as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall($this->addingMethodName, array(new Reference($id), $attributes["alias"]));
            }
        }
    }
}
