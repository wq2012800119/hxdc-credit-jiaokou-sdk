<?php
namespace Sdk\Rap\Measure\Adapter\Measure;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Rap\Measure\Model\Measure;

//use Sdk\Rap\Measure\Utils\MockObjectGenerate;

class MeasureMockAdapter implements IMeasureAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Measure($id);
        //return MockObjectGenerate::generateMeasure($id);
    }
}
