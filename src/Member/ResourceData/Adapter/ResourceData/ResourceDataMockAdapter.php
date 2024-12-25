<?php
namespace Sdk\Member\ResourceData\Adapter\ResourceData;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\ExamineAbleMockAdapterTrait;

use Sdk\Member\ResourceData\Model\ResourceData;

//use Sdk\Member\ResourceData\Utils\MockObjectGenerate;

class ResourceDataMockAdapter implements IResourceDataAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait, ExamineAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return new ResourceData($id);
        //return MockObjectGenerate::generateResourceData($id);
    }

    public function revoke(ResourceData $resourceData) : bool
    {
        unset($resourceData);
        return true;
    }
}
