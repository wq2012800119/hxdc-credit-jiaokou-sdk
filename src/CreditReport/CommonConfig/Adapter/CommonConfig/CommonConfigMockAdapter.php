<?php
namespace Sdk\CreditReport\CommonConfig\Adapter\CommonConfig;

use Sdk\CreditReport\CommonConfig\Model\CommonConfig;

//use Sdk\CreditReport\CommonConfig\Utils\MockObjectGenerate;

class CommonConfigMockAdapter implements ICommonConfigAdapter
{
    public function fetchObject($id)
    {
        return new CommonConfig($id);
       // return MockObjectGenerate::generateCommonConfig($id);
    }

    public function fetchEnterpriseConfig() : CommonConfig
    {
        return $this->fetchObject(1);
    }

    public function fetchNaturalPersonConfig() : CommonConfig
    {
        return $this->fetchObject(1);
    }
    
    public function updateEnterpriseConfig(CommonConfig $commonConfig) : bool
    {
        unset($commonConfig);
        return true;
    }
    
    public function updateNaturalPersonConfig(CommonConfig $commonConfig) : bool
    {
        unset($commonConfig);
        return true;
    }
}
