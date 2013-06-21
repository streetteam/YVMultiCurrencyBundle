<?php

namespace YV\MultiCurrencyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use YV\MultiCurrencyBundle\Lib\CompilerPass\ManagerChainCompilerPass;

class YVMultiCurrencyBundle extends Bundle
{
    const PREFIX = 'yv_multi_currency';
    
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ManagerChainCompilerPass);
    }   
}
