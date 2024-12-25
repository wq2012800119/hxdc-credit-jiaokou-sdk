<?php
namespace Sdk\Evaluation\Indicator\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Evaluation\Indicator\Adapter\Indicator\IIndicatorAdapter;
use Sdk\Evaluation\Indicator\Adapter\Indicator\IndicatorMockAdapter;
use Sdk\Evaluation\Indicator\Adapter\Indicator\IndicatorRestfulAdapter;

class IndicatorRepository extends CommonRepository implements IIndicatorAdapter
{
    const LIST_MODEL_UN = 'INDICATOR_LIST';
    const FETCH_ONE_MODEL_UN = 'INDICATOR_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new IndicatorRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new IndicatorMockAdapter()
        );
    }
}
