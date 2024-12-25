<?php
namespace Sdk\Organization\Department\Adapter\Department;

use Sdk\Common\Adapter\Traits\FetchAbleMockAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleMockAdapterTrait;

use Sdk\Organization\Department\Utils\MockObjectGenerate;

class DepartmentMockAdapter implements IDepartmentAdapter
{
    use OperateAbleMockAdapterTrait, FetchAbleMockAdapterTrait;

    public function fetchObject($id)
    {
        return MockObjectGenerate::generateDepartment($id);
    }
}
