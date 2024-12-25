<?php
namespace Sdk\Organization\Organization\Adapter\Organization;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Organization\Organization\Utils\MockObjectGenerate;

class OrganizationMockAdapter implements IOrganizationAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateOrganization($id);
    }
}
