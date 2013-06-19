<?php

namespace YV\MultiCurrencyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

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
        
        $container->setParameter('yv_multi_currency.account_class', $config['account_class']);   
        $container->setParameter('yv_multi_currency.currency_class', $config['currency_class']);   
        $container->setParameter('yv_multi_currency.currency_account_class', $config['currency_account_class']);   
        $container->setParameter('yv_multi_currency.transaction_class', $config['transaction_class']);  
        
        $container->setParameter('yv_multi_currency.file_upload_root_dir', $config['file_upload_root_dir']);   
        $container->setParameter('yv_multi_currency.file_upload_dir', $config['file_upload_dir']);   
        
        $container->setAlias('yv_multi_currency.account_manager', $config['service']['account_manager']);
        $container->setAlias('yv_multi_currency.currency_manager', $config['service']['currency_manager']);
        $container->setAlias('yv_multi_currency.currency_account_manager', $config['service']['currency_account_manager']);
        $container->setAlias('yv_multi_currency.transaction_manager', $config['service']['transaction_manager']);    
    }
}
