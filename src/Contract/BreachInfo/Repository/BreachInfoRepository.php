<?php
namespace Sdk\Contract\BreachInfo\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Contract\BreachInfo\Adapter\BreachInfo\IBreachInfoAdapter;
use Sdk\Contract\BreachInfo\Adapter\BreachInfo\BreachInfoMockAdapter;
use Sdk\Contract\BreachInfo\Adapter\BreachInfo\BreachInfoRestfulAdapter;

class BreachInfoRepository extends CommonRepository implements IBreachInfoAdapter
{
    const LIST_MODEL_UN = 'CONTRACT_BREACH_INFO_LIST';
    const FETCH_ONE_MODEL_UN = 'CONTRACT_BREACH_INFO_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new BreachInfoRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new BreachInfoMockAdapter()
        );
    }
}
