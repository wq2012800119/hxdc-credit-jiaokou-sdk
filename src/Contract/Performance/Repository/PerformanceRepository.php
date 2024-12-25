<?php
namespace Sdk\Contract\Performance\Repository;

use Marmot\Core;
use Sdk\Common\Repository\CommonRepository;

use Sdk\Contract\Performance\Model\Performance;
use Sdk\Contract\Performance\Adapter\Performance\IPerformanceAdapter;
use Sdk\Contract\Performance\Adapter\Performance\PerformanceMockAdapter;
use Sdk\Contract\Performance\Adapter\Performance\PerformanceRestfulAdapter;

class PerformanceRepository extends CommonRepository implements IPerformanceAdapter
{
    const LIST_MODEL_UN = 'CONTRACT_PERFORMANCE_LIST';
    const FETCH_ONE_MODEL_UN = 'CONTRACT_PERFORMANCE_FETCH_ONE';

    public function __construct()
    {
        parent::__construct(
            new PerformanceRestfulAdapter(
                Core::$container->has('baseurl') ? Core::$container->get('baseurl') : '',
                Core::$container->has('headers') ? Core::$container->get('headers') : []
            ),
            new PerformanceMockAdapter()
        );
    }

    public function ignoreWarning(Performance $performance) : bool
    {
        return $this->getAdapter()->ignoreWarning($performance);
    }
}
