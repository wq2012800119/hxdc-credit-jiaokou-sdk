<?php
namespace Sdk\CreditModule\Taxation\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\CreditModule\Taxation\Adapter\Taxation\ITaxationAdapter;
use Sdk\CreditModule\Taxation\Adapter\Taxation\TaxationMockAdapter;
use Sdk\CreditModule\Taxation\Adapter\Taxation\TaxationRestfulAdapter;

class TaxationRepository extends CommonRepository implements ITaxationAdapter
{
    const LIST_MODEL_UN = 'TAXATION_LIST';
    const FETCH_ONE_MODEL_UN = 'TAXATION_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new TaxationRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new TaxationMockAdapter()
        );
    }
}
