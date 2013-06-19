<?php

namespace YV\MultiCurrencyBundle\Lib\CompilerPass;

class ManagerChainCompilerPass extends BaseChainCompilerPass
{
	public function __construct()
	{
		parent::__construct('managers', 'manager', 'addManager');
	}
}
