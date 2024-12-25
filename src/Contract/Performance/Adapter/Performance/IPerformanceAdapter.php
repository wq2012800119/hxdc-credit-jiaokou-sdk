<?php
namespace Sdk\Contract\Performance\Adapter\Performance;

use Sdk\Contract\Performance\Model\Performance;

use Sdk\Common\Adapter\Interfaces\IFetchAbleAdapter;
use Sdk\Common\Adapter\Interfaces\IOperateAbleAdapter;

interface IPerformanceAdapter extends IFetchAbleAdapter, IOperateAbleAdapter
{
    //忽略告警
    public function ignoreWarning(Performance $performance) : bool;
}
