<?php
namespace Sdk\CreditModule\Collateral\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\CreditModule\Collateral\Adapter\Collateral\ICollateralAdapter;
use Sdk\CreditModule\Collateral\Adapter\Collateral\CollateralMockAdapter;
use Sdk\CreditModule\Collateral\Adapter\Collateral\CollateralRestfulAdapter;

class CollateralRepository extends CommonRepository implements ICollateralAdapter
{
    const LIST_MODEL_UN = 'COLLATERAL_LIST';
    const FETCH_ONE_MODEL_UN = 'COLLATERAL_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new CollateralRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new CollateralMockAdapter()
        );
    }
}
