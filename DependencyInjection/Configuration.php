<?php

namespace YV\MultiCurrencyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('yv_multi_currency');
      
        $rootNode
            ->children()
            ->scalarNode('account_class')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('currency_class')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('currency_account_class')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('transaction_class')->isRequired()->cannotBeEmpty()->end()
            ->end();

        $this->addServiceSection($rootNode);

        return $treeBuilder;
    }
    
    private function addServiceSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('service')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('account_manager')->defaultValue('account_manager.default')->end()
                            ->scalarNode('currency_manager')->defaultValue('currency_manager.default')->end()
                            ->scalarNode('currency_account_manager')->defaultValue('currency_account_manager.default')->end()
                            ->scalarNode('transaction_manager')->defaultValue('transaction_manager.default')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
