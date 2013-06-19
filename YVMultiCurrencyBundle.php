<?php

namespace YV\MultiCurrencyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use TPN\ActivationBundle\Lib\CompilerPass\ManagerChainCompilerPass;

class YVMultiCurrencyBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ManagerChainCompilerPass);
    }   
}
