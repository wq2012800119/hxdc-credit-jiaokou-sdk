<?php
namespace Sdk\Contract\Performance\Adapter\Performance;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Contract\Performance\Model\Performance;

//use Sdk\Contract\Performance\Utils\MockObjectGenerate;

class PerformanceMockAdapter implements IPerformanceAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Performance($id);
       // return MockObjectGenerate::generatePerformance($id);
    }

    //忽略告警
    public function ignoreWarning(Performance $performance) : bool
    {
        unset($performance);
        return true;
    }
}
