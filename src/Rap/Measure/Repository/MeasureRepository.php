<?php
namespace Sdk\Rap\Measure\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Rap\Measure\Adapter\Measure\IMeasureAdapter;
use Sdk\Rap\Measure\Adapter\Measure\MeasureMockAdapter;
use Sdk\Rap\Measure\Adapter\Measure\MeasureRestfulAdapter;

class MeasureRepository extends CommonRepository implements IMeasureAdapter
{
    const LIST_MODEL_UN = 'MEASURE_LIST';
    const FETCH_ONE_MODEL_UN = 'MEASURE_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new MeasureRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new MeasureMockAdapter()
        );
    }
}
