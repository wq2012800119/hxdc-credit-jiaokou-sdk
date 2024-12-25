<?php
namespace Sdk\CreditReport\CommonConfig\Adapter\CommonConfig;

use Sdk\CreditReport\CommonConfig\Model\CommonConfig;

interface ICommonConfigAdapter
{
    public function updateEnterpriseConfig(CommonConfig $enterpriseConfig) : bool;

    public function updateNaturalPersonConfig(CommonConfig $naturalPersonConfig) : bool;

    public function fetchNaturalPersonConfig() : CommonConfig;

    public function fetchEnterpriseConfig() : CommonConfig;
}
