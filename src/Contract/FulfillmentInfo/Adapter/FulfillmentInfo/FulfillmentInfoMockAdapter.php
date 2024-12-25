<?php
namespace Sdk\Contract\FulfillmentInfo\Adapter\FulfillmentInfo;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Contract\FulfillmentInfo\Model\FulfillmentInfo;

//use Sdk\Contract\FulfillmentInfo\Utils\MockObjectGenerate;

class FulfillmentInfoMockAdapter implements IFulfillmentInfoAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new FulfillmentInfo($id);
       // return MockObjectGenerate::generateFulfillmentInfo($id);
    }
}
