<?php
namespace Sdk\CreditModule\Financing\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\CreditModule\Financing\Adapter\Financing\IFinancingAdapter;
use Sdk\CreditModule\Financing\Adapter\Financing\FinancingMockAdapter;
use Sdk\CreditModule\Financing\Adapter\Financing\FinancingRestfulAdapter;

class FinancingRepository extends CommonRepository implements IFinancingAdapter
{
    const LIST_MODEL_UN = 'FINANCING_LIST';
    const FETCH_ONE_MODEL_UN = 'FINANCING_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new FinancingRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new FinancingMockAdapter()
        );
    }
}
