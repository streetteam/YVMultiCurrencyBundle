<?php

namespace YV\MultiCurrencyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use YV\MultiCurrencyBundle\YVMultiCurrencyBundle;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class YVMultiCurrencyExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        $container->setParameter(YVMultiCurrencyBundle::PREFIX . '.account_class', $config['account_class']);   
        $container->setParameter(YVMultiCurrencyBundle::PREFIX . '.currency_class', $config['currency_class']);   
        $container->setParameter(YVMultiCurrencyBundle::PREFIX . '.currency_account_class', $config['currency_account_class']);   
        $container->setParameter(YVMultiCurrencyBundle::PREFIX . '.transaction_class', $config['transaction_class']);  
        
        $container->setParameter(YVMultiCurrencyBundle::PREFIX . '.file_upload_root_dir', $config['file_upload_root_dir']);   
        $container->setParameter(YVMultiCurrencyBundle::PREFIX . '.file_upload_dir', $config['file_upload_dir']);   
        
        $container->setAlias(YVMultiCurrencyBundle::PREFIX . '.account_manager', $config['service']['account_manager']);
        $container->setAlias(YVMultiCurrencyBundle::PREFIX . '.currency_manager', $config['service']['currency_manager']);
        $container->setAlias(YVMultiCurrencyBundle::PREFIX . '.currency_account_manager', $config['service']['currency_account_manager']);
        $container->setAlias(YVMultiCurrencyBundle::PREFIX . '.transaction_manager', $config['service']['transaction_manager']);    
    }
}
