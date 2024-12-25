<?php
namespace Sdk\Contract\BreachInfo\Adapter\BreachInfo;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Contract\BreachInfo\Model\BreachInfo;

//use Sdk\Contract\BreachInfo\Utils\MockObjectGenerate;

class BreachInfoMockAdapter implements IBreachInfoAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new BreachInfo($id);
       // return MockObjectGenerate::generateBreachInfo($id);
    }
}
