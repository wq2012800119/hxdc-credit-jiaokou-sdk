<?php
namespace Sdk\CreditReport\CommonConfig\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\CreditReport\CommonConfig\Model\CommonConfig;
use Sdk\CreditReport\CommonConfig\Adapter\CommonConfig\ICommonConfigAdapter;
use Sdk\CreditReport\CommonConfig\Adapter\CommonConfig\CommonConfigMockAdapter;
use Sdk\CreditReport\CommonConfig\Adapter\CommonConfig\CommonConfigRestfulAdapter;

class CommonConfigRepository extends CommonRepository implements ICommonConfigAdapter
{
    const LIST_MODEL_UN = 'COMMON_CONFIG_LIST';
    const FETCH_ONE_MODEL_UN = 'COMMON_CONFIG_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new CommonConfigRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new CommonConfigMockAdapter()
        );
    }

    public function updateEnterpriseConfig(CommonConfig $enterpriseConfig) : bool
    {
        return $this->getAdapter()->updateEnterpriseConfig($enterpriseConfig);
    }

    public function updateNaturalPersonConfig(CommonConfig $naturalPersonConfig) : bool
    {
        return $this->getAdapter()->updateNaturalPersonConfig($naturalPersonConfig);
    }

    public function fetchNaturalPersonConfig() : CommonConfig
    {
        return $this->getAdapter()->fetchNaturalPersonConfig();
    }

    public function fetchEnterpriseConfig() : CommonConfig
    {
        return $this->getAdapter()->fetchEnterpriseConfig();
    }
}
