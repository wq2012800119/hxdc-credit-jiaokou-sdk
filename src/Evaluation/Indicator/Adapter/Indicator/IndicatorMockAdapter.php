<?php
namespace Sdk\Evaluation\Indicator\Adapter\Indicator;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Evaluation\Indicator\Model\Indicator;

//use Sdk\Evaluation\Indicator\Utils\MockObjectGenerate;

class IndicatorMockAdapter implements IIndicatorAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new Indicator($id);
        //return MockObjectGenerate::generateIndicator($id);
    }
}
